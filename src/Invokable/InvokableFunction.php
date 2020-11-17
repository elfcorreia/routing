<?php

namespace Invokable;

class InvokableFunction {

	private string $name;

	public function __construct(string $name) {		
		if (!function_exists($userfunction_or_callable)) {
				throw new InvalidArgumentException("Function \"$userfunction_or_callable\" must be defined");
		}
		$this->name = $name;
	}

	public function __invoke(...$values) {
		return call_user_func($this->name, $values);
	}

}