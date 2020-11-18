<?php

namespace Routing;

class Route {

	private Path $path;
	private ?string $name = null;	
	private array $verbs = [];
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

	public function setHandler($handler) {
		$this->handler = $handler;
	}

	public function getVerbs(): array {
		return $this->verbs;
	}

	public function setVerbs(array $verbs) {
		$this->verbs = $verbs;
	}

};