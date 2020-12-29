# Routing

This is a library that introduces a minimal set of functions to work with routing in php applications.

# Installation

Install with `composer require elfcorreia/routing`

# Usage

## Adds a route

~~~php
<?php

use function routing/route;

route('index', '/', 'index_view');
route('posts', '/posts', function () { echo 'posts'; });

function index_view() {
    echo 'index';
}
~~~

## Adds a route with url params

~~~php
<?php 

use function routing/route;

route('post-detail', '/posts/{id:int}', function ($id) { /* ... */ });
route('post-detail', '/page/{page:slug}', function ($page) { /* ... */ });

?>
~~~
## Create a link to some route




 - `function  \rounting\route(string $name, array $verbs, string $path, $handler): \Routing\Route;
   - `route('comments', ['GET', 'POST'], '/posts/{id:int}/comments', $handler);`

 - path_type(string $name, string $regexp, $clean_fn): void;    
 - find()
 - link_to()
 - function not_implemented_handler(): void
 - dump_routes()
 - dump_types()
 - debug()