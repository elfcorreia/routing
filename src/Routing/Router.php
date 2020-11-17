<?php

namespace Routing;

class Router {

	private $routes = [];
	private $types = [];

	public function add(Route $route): void {
		if ($route->getName()) {
			$this->routes[$route->getName()] = $route;
		} else {
			$this->routes[] = $route;
		}
	}

	public function addType(PathType $type): void {
		$this->types[$type->getName()] = $type;
	}

	public function find($verb, $uri): FindResult {
		return new FindResult(null);
	}

	public function getRoutes() {
		return $this->routes;
	}	

	public function getTypes() {
		return $this->types;
	}

	public function getRouteByName(string $name): ?\Routing\Route {
		return $this->routes[$name];
	}

}