<?php

namespace Routing;

abstract class PathType {

	private $name;
	private $preg;

	static array $instances = [];

	public static function add(PathType $instance): void {
		self::$instances[$instance->getName()] = $instance;
	}

	public static function getByName(string $name): PathType {
		if (!array_key_exists($name, self::$instances)) {
			throw new \Exception("Path type \"$name\" not found!");
		}
		return self::$instances[$name];
	}

	public function __construct($name, $preg) {
		$this->name = $name;
		$this->preg = $preg;
	}

	public function getName() {
		return $this->name;
	}

	public function getPreg() {
		return $this->preg;
	}

	public abstract function clean(string $value);

	public function __toString() {
		return '<PathType name="'.$this->path.'" preg="'.$this->preg.'">';
	}
	
};