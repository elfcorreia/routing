<?php

namespace Routing;

abstract class PathType {

	private $name;
	private $preg;

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