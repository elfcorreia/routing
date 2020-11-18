<?php

namespace Routing;

class FindResult {
	
	public ?Route $route;
	public int $code;
	public array $args = [];

	public function __construct(?Route $route, int $code) {
		$this->route = $route;
		$this->code = $code;
	}

	public function getRoute() {
		return $this->route;
	}

	public function getCode() {
		return $this->code;
	}

	public function getArgs(): array {
		return $this->args;
	}

}