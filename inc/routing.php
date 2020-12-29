<?php

namespace routing {

	function not_implemented_handler(): void {
		echo 'Not implemented yet!';
	}

	function init_if_needed(): void {
		global $_ROUTER;
		if (!$_ROUTER) {
			\Routing\PathType::add(new \Routing\PathTypes\IntPathType());
			$_ROUTER = new \Routing\Router();			
		}
	}

	function path_type(string $name, string $regexp, $clean_fn): void {
		\Routing\PathType::add(new \Routing\CustomTypePath($name, $regexp, $clean_fn));
	}

	// route(name, path, handler)
	// route(name, verbs, path, handler)
	function route(string $name, $path_or_verbs, $a = null, $b = null): \Routing\Route {
		global $_ROUTER;
		init_if_needed();		

		if (is_array($path_or_verbs)) {
			if (!is_string($a)) {
				throw new IllegalArgumentException("Expected string path but received \"".strval($a)."\"");
			}
			$r = new \Routing\Route($a);
			$r->setName($name);
			$r->setVerbs($path_or_verbs);
			$r->setHandler(\Invokable\Invokable::create($b ? $b : 'routing\\not_implemented_handler'));
		} else if (is_string($path_or_verbs)) {
			$r = new \Routing\Route($path_or_verbs);
			$r->setName($name);
			$r->setHandler(\Invokable\Invokable::create($a ? $a : 'routing\\not_implemented_handler'));
		} else {
			throw IllegalArgumentException("expected array or string but received \"".strval($path_or_verbs)."\"");
		}
		$_ROUTER->add($r);
		return $r;
	}

	function find(string $verb, string $uri): \Routing\FindResult {
		global $_ROUTER;
		init_if_needed();

		return $_ROUTER->find($verb, $uri);
	}

	function link($to, ...$values) {
		global $_ROUTER;
		init_if_needed();
		return $_ROUTER->getRouteByName($to)->getPath();
	}

	function dump_routes() {
		global $_ROUTER;
		init_if_needed();

		foreach ($_ROUTER->getRoutes() as $r) {
			echo '<p>';
			echo '<b>'.(empty($r->getVerbs()) ? 'ANY' : implode('|', $r->getVerbs())).'</b> ';
			echo $r->getPath()->getPath();
			echo '<br/><small>name: <i>'.$r->getName().'</i></small>';			
			echo '<pre>';
			echo "preg: ".htmlspecialchars($r->getPath()->getPreg())."\n";
			echo "params:\n";
			foreach ($r->getPath()->getParams() as $k => $v) {
				echo "   - $k: ".get_class($v)."\n";
			}
			echo "handler: ".$r->getHandler()."\n";
			echo '</pre>';
			echo '</p>';
		}		
	}

	function dump_types() {
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
		echo '<hr>';
	}

	function debug() {
		global $_ROUTER;
		init_if_needed();
		echo '<p><b>find("'.$_SERVER['REQUEST_METHOD'].'", "'.$_SERVER['REQUEST_URI'].'")</b></p>';
		$r = find($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
		echo '<pre>';
		echo 'Code: '.$r->getCode()."\n";
		echo 'Handler: '.$r->getRoute()->getHandler()."\n";
		echo 'Args: '.json_encode($r->getArgs())."\n";
		echo '</pre>';		
	}
}