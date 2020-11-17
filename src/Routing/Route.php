<?php

namespace Routing;

class Route {

	private Path $path;
	private ?string $name = null;	
	private $handler = null;

	public function __construct(string $path) {
		$this->path = new Path($path);
	}

	public function setName(string $name): void {
		$this->name = $name;
	}

	public function getName(): ?string {
		return $this->name;
	}	

	public function getPath(): Path {
		return $this->path;
	}
 
	public function getHandler() {
		return $this->handler;
	}

};