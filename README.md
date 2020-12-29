# Routing library

This is a library that introduces a minimal set of functions to work with routing in php applications.

## Installation

Install with `composer require elfcorreia/routing`

## Quick start

~~~php
<?php

use function routing\route;

route('index', [], '/');
route('posts', [], '/posts');
route('post-detail', [], '/posts/{name:slug}');

$r = routing\find($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URL']);

switch($r->getCode()) {
    case 405:
        echo 'method not allowed!'
    case 200:
        call_user_func($r->getRoute()->getHandler(), $r->getParams());
    default:
        echo 'not found!';
}
~~~

## Usage

All the functions from this library are in `routing` namespace. So in order to use its you must [import a function](https://www.php.net/manual/en/language.namespaces.importing.php) or call it by its qualified name.

### Adds a route

Add a **route** calling the function `route` with a **name**, an array of **verbs**, and a **path**. Example:
~~~php
route('index', ['GET'], '/');
route('posts', ['GET', 'POST'], /posts');
~~~

An empty list of verbs indicates any http verbs.

When not specified, the `routing/not_implemented_yet_handler` its used. To specify a handler, you must pass a [callback/callable](https://www.php.net/manual/en/language.types.callable.php) variable.
~~~php
route('index', ['GET'], '/', 'index_view');
route('posts', ['GET', 'POST'], '/posts', function () { echo 'posts'; });

function index_view() {
    echo 'index';
}

class A {
    public function foo() { echo 'oi'; }
}
~~~

### Adds a route with path params

~~~php
<?php 

use function routing/route;

route('post-detail', [], '/posts/{id:int}', function ($id) { /* ... */ });
route('page-detail', [], '/page/{page:slug}', function ($page) { /* ... */ });

?>
~~~

A path param is specified in a path with '{name:type}', where name must be a valid PHP identifier and type should be a valid path type.

## Create a link to some route
~~~php
link_to('post', 'silva');
~~~