<?php

namespace Routing;

class Path {

	const PARAM_PREG = '/{(?P<name>[^}]+):(?P<type>[^}]+)}/';

	private string $path;
	private string $preg;	
	private array $params = [];

	public function __construct(string $path) {
		$this->path = $path;
		$aux = str_replace('/', '\\/', $path).'/';
		$this->preg = '/'.preg_replace_callback(self::PARAM_PREG, function ($m) {			
			$pt = PathType::getByName($m[2]);
			$this->params[$m[1]] = $pt;
			return '(?P<'.$m[1].'>'.$pt->getPreg().')';
		}, $aux);
	}

	public function getPath(): string {
		return $this->path;
	}

	public function getPreg(): string {
		return $this->preg;
	}

	public function getParams(): array {
		return $this->params;
	}

	public function __toString(): string {
		return '<Path path="'.$this->path.'" preg="'.$this->preg.'">';
	}

};