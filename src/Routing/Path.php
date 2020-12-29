<?php

namespace Routing;

class Path {

	const PARAM_PREG = '/{(?P<name>[^}]+):(?P<type>[^}]+)}/';

	private string $path;
	private string $preg;	
	private array $params = [];

	public function __construct(string $path) {		
		$path = trim($path);
		$this->path = $path;
		$aux = $path;
		$n = strlen($path);		
		if ($n > 0 && substr($path, $n - 1, 1) == '/') {
			$aux = substr($path, 0, $n - 2);
		}
		$aux = str_replace('/', '\\/', $aux);
		$aux = str_replace('.', '\\.', $aux);
		$this->preg = preg_replace_callback(self::PARAM_PREG, function ($m) {			
			$pt = PathType::getByName($m[2]);
			$this->params[$m[1]] = $pt;
			return '(?P<'.$m[1].'>'.$pt->getPreg().')';
		}, $aux);
		$this->preg = '/^'.$this->preg.'$/';
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