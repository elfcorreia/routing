<?php

namespace Invokable;

class InvokableFunction {

	private string $name;

	public function __construct(string $name) {		
		if (!function_exists($name)) {
				throw new InvalidArgumentException("Function \"$name\" must be defined");
		}
		$this->name = $name;
	}

	public function __invoke(...$values) {
		return call_user_func($this->name, $values);
	}

	public function __toString() {
		return "function ".$this->name;
	}

}