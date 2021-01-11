<?php

namespace Routing\PathTypes;

class PathPathType extends \Routing\PathType {
	
	public function __construct() {
        parent::__construct('*', '[a-zA-Z0-9\-\._\~\/]*');        
	}

	public function clean(string $value) {
		return filter_var($value, FILTER_SANITIZE_URL);
	}
	
}