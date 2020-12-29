<?php

namespace Routing;

class RouteResult {
	
	public ?Route $route;
	public array $args;

	public function __construct(?Route $route = null, ?array $args = null) {
		$this->route = $route;
		$this->args = $args ? $args : [];
	}

	public function getRoute() {
		return $this->route;
	}

	public function getArgs(): array {
		return $this->args;
	}

}