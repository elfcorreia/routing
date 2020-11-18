<?php

namespace Invokable;

class InvokableCallable {
	
	private $obj;

	public function __construct(callable $obj) {		
		$this->obj = $obj;		
	}

	public function __invoke(...$values) {
		$f = $this->obj;
		return $f(...$values);		
	}

	public function __toString() {
		return 'callable object';
	}

}