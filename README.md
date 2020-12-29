# Routing

This is a library that introduces a minimal set of functions to work with routing in php applications.

 - function route(string $name, string $path, array $verbs = null, $name = null): \Routing\Route;

 - `route('index', '/');`
 - `route('posts', '/posts');`
 - `route('post-detail', '/posts/{id:int}');`
 - `route('comments', ['GET', 'POST'], '/posts/{id:int}/comments');`

 - path_type(string $name, string $regexp, $clean_fn): void;
 - find()
 - link_to()
 - function not_implemented_handler(): void
 - dump_routes()
 - dump_types()
 - debug()