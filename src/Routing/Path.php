<?php

namespace Routing;

class Path {

	const PARAM_PREG = '/{(?P<name>[^}]+):(?P<type>[^}]+)}/';

	private string $path;
	private string $preg;

	public function __construct(string $path) {
		$this->path = $path;			
		$this->preg = preg_replace_callback(self::PARAM_PREG, function ($m) {
			return '(?P<'.$m[1].'>'.
				RoutePathType::getByTypeName($m[2])->getPreg()
			.')';
		}, $path);
	}

	public function getPath(): string {
		return $this->path;
	}

	public function getPreg(): string {
		return $this->preg;
	}

	public function __toString(): string {
		return '<Path path="'.$this->path.'" preg="'.$this->preg.'">';
	}

};