<?php

namespace MasterStudy\Lms\Routing\Swagger\Routes\Course;

use MasterStudy\Lms\Routing\Swagger\RequestInterface;
use MasterStudy\Lms\Routing\Swagger\ResponseInterface;
use MasterStudy\Lms\Routing\Swagger\Route;

class UpdateAnnouncement extends Route implements RequestInterface, ResponseInterface {
	public function request(): array {
		return array(
			'announcement' => array(
				'type'     => 'string',
				'required' => true,
			),
		);
	}

	public function response(): array {
		return array(
			'status' => 'ok',
		);
	}

	public function get_summary(): string {
		return 'Updates course announcement';
	}

	public function get_description(): string {
		return 'Updates course announcement';
	}
}
