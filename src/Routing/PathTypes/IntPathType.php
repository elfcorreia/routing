<?php

namespace Routing\PathTypes;

class IntPathType extends \Routing\PathType {
	
	public function __construct() {
		parent::__construct('int', '\d+');
	}

	public function clean(string $value) {
		return filter_var($value, FILTER_VALIDATE_INT);
	}
	
}