<?php

namespace routing {

	function register_type(string $name, string $regexp) {
		global $_ROUTER;
		if (!$_ROUTER) { 
			$_ROUTER = new \Routing\Router();
		}

		
		$_ROUTER->addType()
	}

	function register_route(string $path, $userfunc_or_callable): \Routing\Route {
		global $_ROUTER;
		if (!$_ROUTER) { 
			$_ROUTER = new \Routing\Router();
		}

		$r = new \Routing\Route($path, $userfunc_or_callable);
		$_ROUTER->add($r);

		return $r;
	}

	function find(string $verb, string $uri): \Routing\FindResult {
		global $_ROUTER;
		if (!$_ROUTER) { 
			$_ROUTER = new Routing\Router();
		}

		return $_ROUTER->find($verb, $uri);
	}

	function link($to, ...$values) {
		global $_ROUTER;
		return $_ROUTER->getRouteByName($to)->getPath();
	}

	function dump() {
		global $_ROUTER;
		if (!$_ROUTER) { 
			$_ROUTER = new \Routing\Router();
		}
		echo '<h2>Routing</h2>';
		
		echo '<h3>Types</h3>';
		echo '<table border="1">';
		echo '<tbody>';
		foreach ($_ROUTER->getTypes() as $t) {
			echo '<tr>';
			echo '<td>'.$t->getName().'</td>';
			echo '<td>'.$t->getPreg().'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';

		echo '<h3>Routes</h3>';
		echo '<table border="1">';
		echo '<tbody>';
		foreach ($_ROUTER->getRoutes() as $r) {
			echo '<tr>';
			echo '<td>'.$r->getPath()->getPath().'</td>';
			echo '<td>'.$r->getName().'</td>';
			echo '<td>'.link($r->getName()).'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}
}