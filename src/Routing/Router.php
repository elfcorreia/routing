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

	public function find($verb, $url): FindResult {
		global $_ROUTER;
		$aux = parse_url($url);		
		$collected_uri_args = [];
		$args = [];
		foreach ($_ROUTER->getRoutes() as $r) {						
			$match = preg_match(
				$r->getPath()->getPreg(), 
				$aux['path'], 
				$collected_uri_args, 
				PREG_UNMATCHED_AS_NULL
			);
			$e = preg_last_error();
			if ($e !== PREG_NO_ERROR) {
				throw new \Exception("preg_last_error = $e");
			}
			//var_dump($match);
			if ($match) {
				$route = $r;
				if (!empty($r->getVerbs()) && !in_array($verb, $r->getVerbs())) {
					return new FindResult($r, 405);
				}				
				return new FindResult($r, 200);
			}
		}
//				// collect params, oportunity to convert from str to other php types
//				foreach ($r['params'] as $name => $type) {
//					if (isset($collected_uri_args[$name])) {
//						$type = $r['params'][$name];
//						$clean_fn = $_ROUTER['TYPES'][$type]['clean'];
//						$args[$name] = $clean_fn($collected_uri_args[$name]);
//					}				 
//				}
//				return 200;
//				}
//		}
//		return 404;
		return new FindResult(null, 404);
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