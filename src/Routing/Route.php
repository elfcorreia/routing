<?php

namespace Routing;

class Route {

	private Path $path;
	private ?string $name = null;
	private ?array $userdata = null;

	public function __construct(string $path, ?array $userdata = null, ?string $name = null) {
		$this->path = new Path($path);
		$this->userdata = $userdata;
		$this->name = $name;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function getPath(): Path {
		return $this->path;
	}
 
	public function getUserdata(): ?array {
		return $this->userdata;
	}

	public function __toString() {
		return 'route path="'.$this->path.'"';
	}

};