<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
require_once STM_LMS_PATH . '/includes/starter-theme/helpers/themes.php';

/**
 * Class Loader
 * base plugin functions here
 */

class Loader {

	public $plugin_slug              = 'masterstudy-lms-learning-management-system';
	public $starter_theme_version    = '1.0.0';
	public $starter_theme_slug       = 'starter_lms_demo_installer';
	public $child_starter_theme_slug = 'ms-lms-starter-theme-child';
	private $ms_lms_themes           = array( 'smarty', 'masterstudy', 'globalstudy', 'betop', 'starter-text-domain' );

	protected function get_current_theme_text_domain() {
		$current_theme = wp_get_theme();
		$text_domain = $current_theme->get( 'TextDomain' );

		if ( is_a( wp_get_theme()->parent(), '\WP_Theme' ) ) {
			$text_domain = wp_get_theme()->parent()->get( 'TextDomain' );
		}

		return $text_domain;
	}

	/** Is Free MS active */
	private function check_is_free_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		return is_plugin_active( 'masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php' );
	}

	public function __construct() {
		if ( false === $this->check_is_free_active() ) {
			return;
		}
		if ( in_array( $this->get_current_theme_text_domain(), $this->ms_lms_themes ) ) {
			return;
		}

		/** add body class */
		add_filter( 'admin_body_class', array( $this, 'add_body_class' ) );
		add_filter( 'admin_menu', array( $this, 'add_starter_install__admin_menu' ) );

		add_action( 'wp_ajax_stm_install_starter_theme', array( $this, 'stm_install_starter_theme' ) );

		/** notice logic */
		/** add option for show notice */
		$this->add_show_notice_option();

		if ( $this->is_show_notice() ) {
			add_action( 'admin_notices', array( $this, 'show_load_theme_notice' ) );

			/** action to remove notice */
			add_action(
				'wp_ajax_stm_lms_hide_notice_' . $this->plugin_slug,
				array( $this, 'hide_notice' ),
				$priority      = 10,
				$accepted_args = 1
			);
		}
	}
	/** show template */

	public function theme_starter() {
		/** load setup template **/
		require_once STM_LMS_PATH . '/includes/starter-theme/templates/setup-start.php';
	}

	public function add_starter_install__admin_menu() {
		$page_title = esc_html__( 'MasterStudy Starter Theme', 'masterstudy-lms-learning-management-system' );
		add_submenu_page( 'themes.php', $page_title, $page_title, 'manage_options', $this->starter_theme_slug, array( $this, 'theme_starter' ) );
	}

	public function add_body_class( $classes ) {
		if ( ! empty( $_GET['page'] ) && $this->starter_theme_slug === $_GET['page'] ) {
			$classes .= ' lms-starter-theme-setup';
		}
		return $classes;
	}
	/** Ajax query - installation */
	public function stm_install_starter_theme() {

		check_ajax_referer( 'stm_install_starter_theme', 'nonce' );

		if ( ! current_user_can( 'manage_options' )
			 || ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		if ( empty( $_POST['type'] ) || in_array( 'type', $_POST ) ) {
			wp_send_json_error( array( 'error' => 'Error occured. No type.' ) );
			return;
		}

		if ( empty( $_POST['slug'] ) || in_array( 'slug', $_POST ) ) {
			wp_send_json_error( array( 'error' => 'No plugin slug' ) );
			return;
		}

		$slug = sanitize_text_field( $_POST['slug'] );
		$type = $_POST['type'];

		$result = $this->install( $slug, $type );

		/** if this is last install step, remove notice */
		if ( 'true' === ( $_POST['is_last'] ) ) {
			$this->set_show_notice_option( false );
			wp_send_json_success( $result );
		} else {
			wp_send_json_success( $result );
		}

	}

	private function install( $slug, $type ) {
		$install_class = null;

		switch ( $type ) {
			case 'theme':
				$install_class = \LMS\StarterTheme\Helpers\Themes::class;
				break;
		}

		if ( null === $install_class ) {
			wp_send_json_error( array( 'error' => 'Class not exist' ) );
		}

		$data = $install_class::get_item_info( $slug );
		if ( false === $data['is_installed'] ) {
			$install_class::install( $slug );
			$install_class::activate( $slug );
		}

		if ( $data['is_installed'] && false === $data['is_active'] ) {
			$install_class::activate( $slug );
		}

		if ( 'content' === $type ) {
			return $install_class::get_item_info( $slug, 'after' );
		} else {
			return $install_class::get_item_info( $slug );
		}
	}

	/**
	 * Retrieves an option value for option name `masterstudy_lms_install_starter_theme_notice_`.
	 * @return mixed Value of the option.
	 */
	public function get_install_starter_theme_notice_option() {
		$option = get_option( 'masterstudy_lms_install_starter_theme_notice' );
		return $option;
	}

	/** check is need to show notice to install starter theme */
	private function is_show_notice() {

		$option = $this->get_install_starter_theme_notice_option();
		if ( false === $option ) {
			return true;
		}
		return $option;
	}

	private function get_user_id() {

		if ( ! function_exists( 'wp_get_current_user' ) ) {
			return null;
		}

		$user = wp_get_current_user();

		if ( ! property_exists( $user, 'data' ) ) {
			return null;
		}

		if ( ! property_exists( $user->data, 'ID' ) ) {
			return null;
		}

		return $user->data->ID;
	}

	/**
	 * Adds a new option for option name `masterstudy_lms_install_starter_theme_notice_`.
	 * @return bool True if the option was added, false otherwise.
	 */
	private function add_show_notice_option() {
		$user_id = $this->get_user_id();
		if ( null === $user_id ) {
			return false;
		}

		$option_exist = $this->get_install_starter_theme_notice_option();
		$option_key   = false;

		if ( false !== $option_exist ) {
			$option_key = array_search( $user_id, array_column( $option_exist, 'user_id' ) );
		}

		if ( false !== $option_key ) {
			return false;
		}
		add_option( 'masterstudy_lms_install_starter_theme_notice', true );

	}

	public function set_show_notice_option( $status ) {
		update_option( 'masterstudy_lms_install_starter_theme_notice', $status );
	}

	/**
	 * Set 'show_notice' user key to false
	 */
	public function hide_notice() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$this->set_show_notice_option( false );
		header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
		exit;
	}

	/** Show notice to install starter theme */
	public function show_load_theme_notice() {

		$this->set_show_notice_option( true );
		$hide_notice_url = add_query_arg(
			array( 'action' => 'stm_lms_hide_notice_' . $this->plugin_slug ),
			admin_url( 'admin-ajax.php' )
		);
		$live_url = 'https://masterstudy.stylemixthemes.com/lms-plugin/';

		echo '<div class="notice notice-info is-dismissible">
				<p class="install-text">' . esc_html( __( 'Thank you for installing the Masterstudy LMS Plugin. What to do next, try the ', 'masterstudy-lms-learning-management-system' ) ) . '<b>' . esc_html( __( 'Masterstudy Starter Theme.', 'masterstudy-lms-learning-management-system' ) ) . '</b>  &nbsp;</p>
				<p>
				<button class="buttonload button starter_install_theme_btn" name="starter_install_theme_btn" >
				  <span class="ui-button-text">' . esc_html( __( 'Install Now', 'masterstudy-lms-learning-management-system' ) ) . '</span>
					<i class="fa fa-refresh fa-spin installing"></i>
					<i class="fa fa-check downloaded" aria-hidden="true"></i>
				</button>
					<a href="' . esc_attr( $live_url ) . '" class="button" target="_blank">
					' . esc_html( __( 'Live Demo', 'masterstudy-lms-learning-management-system' ) ) . '
					</a>
					<a href="' . esc_attr( $hide_notice_url ) . '" class="button">
					' . esc_html( __( 'No Thanks', 'masterstudy-lms-learning-management-system' ) ) . '
					</a>
				</p>
			</div>';
	}
}
new Loader();
