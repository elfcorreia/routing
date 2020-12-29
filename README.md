# Routing library

This is a library that introduces a minimal set of functions to work with routing in php applications.

## Installation

Install with `composer require elfcorreia/routing`

## Usage

### Namespace

All the functions from this library are in `routing` namespace. So in order to use its you must [import a function](https://www.php.net/manual/en/language.namespaces.importing.php) or call it by its qualified name.

### Adds a route

Add a **route** calling the function `route` with a **name** and a **path**. Example:

~~~php
<?php

use function routing/route;

route('index', '/');
route('posts', '/posts');
~~~

When not especified, the routing/not_implemented_yet_handler its used!.



~~~php
<?php

use function routing/route;

route('index', '/', 'index_view');
route('posts', '/posts', function () { echo 'posts'; });

function index_view() {
    echo 'index';
}
~~~


~~~php
<?php

use function routing/route;

route('index', '/', 'index_view');
route('posts', '/posts', function () { echo 'posts'; });

function index_view() {
    echo 'index';
}
~~~

### Adds a route with path params

~~~php
<?php 

use function routing/route;

route('post-detail', '/posts/{id:int}', function ($id) { /* ... */ });
route('page-detail', '/page/{page:slug}', function ($page) { /* ... */ });

?>
~~~

A path param is specified in a path with '{name:type}', where name must be a valid PHP identifier and type should be a valid path type.

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