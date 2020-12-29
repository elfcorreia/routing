<?php

namespace Routing\PathTypes;

class StringPathType extends \Routing\PathType {
	
	public function __construct() {
		parent::__construct('str', '[^\/]+');
	}

	public function clean(string $value) {
		return filter_var($value, FILTER_SANITIZE_STRING);
	}
	
}