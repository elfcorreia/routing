<?php

namespace Invokable;

class Invokable {

	public static function create($userfunction_or_callable) {
		if (is_string($userfunction_or_callable)) {
			if (!function_exists($userfunction_or_callable)) {
				throw new \InvalidArgumentException("Function \"$userfunction_or_callable\" must be defined");
			} else {
				return new InvokableFunction($userfunction_or_callable);
			}
		} else {
			if (is_callable($userfunction_or_callable)) {
				return new InvokableCallable($userfunction_or_callable);
			} else {
				throw new \InvalidArgumentException("Expected string or callable but received ".gettype($userfunction_or_callable));
			}
		}
	}

}