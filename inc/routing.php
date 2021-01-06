<?php

namespace routing {

	function not_implemented_yet_handler(): void {
		echo 'Not implemented yet!';
	}

	function init_if_needed(): void {
		global $_ROUTER;
		if (!$_ROUTER) {
			\Routing\PathType::add(new \Routing\PathTypes\IntPathType());
			\Routing\PathType::add(new \Routing\PathTypes\StringPathType());
			$_ROUTER = new \Routing\Router();			
		}
	}

	function path_type(string $name, string $regexp, ?callable $callback = null): void {
		\Routing\PathType::add(new \Routing\PathTypes\CustomPathType($name, $regexp, $callback));
	}

	function route(string $path, ?callable $callback = null, ?string $name = null): \Routing\Route {
		global $_ROUTER;
		init_if_needed();
		$name = $name ? $name : 'untitled'.count($_ROUTER->getRoutes());
		$callback = $callback ? $callback : '\\routing\\not_implemented_yet_handler';
		$r = new \Routing\Route($path, $callback, $name);
		$_ROUTER->add($r);
		return $r;
	}

	function find(string $uri): \Routing\RouteResult {
		global $_ROUTER;
		init_if_needed();
		return $_ROUTER->find($uri);
	}

	function link($to, ...$values) {
		global $_ROUTER;
		init_if_needed();
		return $_ROUTER->getRouteByName($to)->getPath();
	}

	function debug() {
		global $_ROUTER;
		init_if_needed();

		echo '<p><b>find("'.$_SERVER['REQUEST_URI'].'")</b></p>';
		$r = find($_SERVER['REQUEST_URI']);
		echo '<pre>';
		echo 'Route: '.$r->getRoute()."\n";
		if ($r->getRoute()) {
			echo 'Callback: '.$r->getRoute()->getCallback()."\n";
			echo 'Args: '.json_encode($r->getArgs())."\n";
		}
		echo '</pre>';

		echo '<hr/>';
		echo '<h3>Routes</h3>';

		foreach ($_ROUTER->getRoutes() as $r) {
			echo '<p>';
			echo $r->getPath()->getPath();
			echo '<br/><small>name: <i>'.$r->getName().'</i></small>';			
			echo '<pre>';
			echo "preg: ".htmlspecialchars($r->getPath()->getPreg())."\n";
			echo "params:\n";
			foreach ($r->getPath()->getParams() as $k => $v) {
				echo "   - $k: ".get_class($v)."\n";
			}
			echo "callback: ".$r->getCallback()."\n";
			echo '</pre>';
			echo '</p>';
		}		
		echo '<hr/>';

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
	}
}