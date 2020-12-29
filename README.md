# Routing library

This is a library that introduces a minimal set of functions to work with routing in php applications.

## Installation

Install with `composer require elfcorreia/routing @dev`

## Quick start

~~~php
<?php

use function routing\route;
use function routing\debug;

route('/');
route('/posts');
route('/posts/{name:str}');

debug();
~~~

## Usage

All the functions from this library are in `routing` namespace. So in order to use its you must [import a function](https://www.php.net/manual/en/language.namespaces.importing.php) or call it by its qualified name.

### Adds a route

Add a **route** calling the function `route` with a required **path"**, an optional **callback**, and and optional **name**. Example:
~~~php
route('/');
route('/posts');
route('/posts/{name:str}');
route('/posts/{name:str}/comments');
~~~

The function `routing/not_implemented_yet_handler` its the default **callback** when none is specified. In order to do that you must pass a [callback/callable](https://www.php.net/manual/en/language.types.callable.php) variable.
~~~php
// a function name
route('/', 'index_view'); 
// an anonimous function 
route('/posts', function () { /**/ });
// an arrow function
route('/posts/{name:str}', fn ($name) => { /**/ });
// an static class method
route('/posts/{name:str}/comments', 'PostsController::comments');
// an instance method
route('/posts/{name:str}/comments', [new MyClass(), 'comments']);
~~~
A path param is specified in a path with '{name:type}', where name must be a valid PHP identifier and type should be a valid path type.