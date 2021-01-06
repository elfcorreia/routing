<?php

namespace Routing\PathTypes;

class CustomPathType extends \Routing\PathType {
	
	private $callback = null;

	public function __construct(string $name, string $regexp, callable $callback) {
		parent::__construct($name, $regexp);
		$this->callback = $callback;
	}

	public function clean(string $value) {
		$a = $this->callback;
		return $a($value);
	}

}