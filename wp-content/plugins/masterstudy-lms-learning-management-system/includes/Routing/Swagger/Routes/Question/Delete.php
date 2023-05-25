<?php

namespace MasterStudy\Lms\Routing\Swagger\Routes\Question;

use MasterStudy\Lms\Routing\Swagger\RequestInterface;
use MasterStudy\Lms\Routing\Swagger\ResponseInterface;
use MasterStudy\Lms\Routing\Swagger\Route;

class Delete extends Route implements RequestInterface, ResponseInterface {
	public function request(): array {
		return array();
	}

	public function response(): array {
		return array();
	}

	public function get_summary(): string {
		return 'Deletes question';
	}

	public function get_description(): string {
		return 'Deletes question';
	}
}
