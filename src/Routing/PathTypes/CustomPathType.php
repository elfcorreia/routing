<?php

namespace Routing\PathTypes;

class CustomPathType extends \Routing\PathType {
	
	private $clean_fn = null;

	public function __construct(string $name, string $regexp, $clean_fn) {
		parent::__construct($name, $regexp);
		$this->clean_fn = Invokable::create($clean_fn);
	}

	public function clean(string $value) {
		$a = $this->clean_fn;
		return $a($value);
	}

}