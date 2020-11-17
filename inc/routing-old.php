<?php

/** @file */

define('ROUTE_PARAM_PREG', '/{(?P<name>[^}]+):(?P<type>[^}]+)}/');

global $_ROUTER;

$_ROUTER = [
	'ROUTES' => [],
	'TYPES' => [
		'slug' => [
			'preg' => '[a-zA-Z0-9_-]+',
			'clean' => function ($v) { return $v; }
		],
		'int' => [
			'preg' => '\d+',
			'clean' => function ($v) { return filter_var($v, FILTER_VALIDATE_INT); }
		]
	]
];

// TODO: create functions to register new types

/**
 * @brief Adds a new route to handle requests
 */
function router_add_route(string $path, array $options): void {
	global $_ROUTER;	
	$aux = [];
	preg_match_all(ROUTE_PARAM_PREG, $path, $aux, PREG_SET_ORDER);		
	$params = [];
	foreach ($aux as $p) {
		if (!isset($_ROUTER['TYPES'][$p['type']])) {
			throw new Exception('unknowing router type '.$match[2]);
		}
		$params[$p['name']] = $p['type'];
	}
	$re_path = preg_replace_callback(ROUTE_PARAM_PREG, function ($m) {
		global $_ROUTER;
		return '(?P<'.$m[1].'>'.$_ROUTER['TYPES'][$m[2]]['preg'].')';
	}, $path);
	
	$re_path = '/^'.str_replace('/', '\\/', $re_path).'$/';	
		
	$route = [
		'path' => $path,
		're_path' => $re_path,
		'name' => $options['name'],
		'verbs' => $options['verbs'],
		'handler' => $options['handler'],
		'before' => isset($options['before']) ? $options['before']: [],
		'params' => $params
	];
	//var_dump($route);
	$_ROUTER['ROUTES'][] = $route;
}

/**
 * @brief Find a route handler that matches the request 
 */
function router_find(string $method, string $url, &$route, &$args): int {
	global $_ROUTER;	
	$aux = parse_url($url);
	$collected_uri_args = [];
	$args = [];
	foreach ($_ROUTER['ROUTES'] as $r) {
		$re = $r['re_path'];		
		$match = preg_match($re, $aux['path'], $collected_uri_args, PREG_UNMATCHED_AS_NULL);		
		if (preg_last_error() !== PREG_NO_ERROR) {
			throw new \Exception();
		}
		//var_dump($match);
		if ($match) {
			$route = $r;
			if (!in_array($method, $r['verbs'])) {
				return 405;
			}
			// collect params, oportunity to convert from str to other php types
			foreach ($r['params'] as $name => $type) {
				if (isset($collected_uri_args[$name])) {
					$type = $r['params'][$name];
					$clean_fn = $_ROUTER['TYPES'][$type]['clean'];
					$args[$name] = $clean_fn($collected_uri_args[$name]);
				}				 
			}
			return 200;
		}
	}
	return 404;
}

// TODO: variadic args
function router_urlto($route_name) {
	global $_ROUTER;	
	foreach ($_ROUTER['ROUTES'] as $r) {		
		if ($r['name'] === $route_name) {
			return $r['path'];
		}
	}
	throw new \Exception('Route named \"'.$route_name."\" not found!");
}

function router_hasroute($route_name) {
	global $_ROUTER;
	foreach ($_ROUTER['ROUTES'] as $r) {		
		if ($r['name'] === $route_name) {
			return true;
		}
	}
	return false;
}