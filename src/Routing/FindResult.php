<?php

namespace Routing;

class FindResult {
	
	public ?Route $route;
	public bool $error = false;

	public function __construct(?Route $route) {
		$this->route = $route;
	}

}