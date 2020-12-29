<?php

namespace Routing;

class Route {

	private Path $path;
	private ?string $name = null;
	private $callback = null;

	public function __construct(string $path, ?callable $callback = null, ?string $name = null) {
		$this->path = new Path($path);
		$this->callback = $callback;
		$this->name = $name;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function getPath(): Path {
		return $this->path;
	}
 
	public function getCallback(): ?callable {
		return $this->callback;
	}

	public function __toString() {
		return 'route path="'.$this->path.'"';
	}

};