# Routing

This is a library that introduces a minimal set of functions to work with routing in php applications.

 - `function \rounting\route(string $name, string $path, $handler): \Routing\Route;
   - `route('index', '/', 'index_view');`
   - `route('posts', '/posts', function () { echo 'posts'; });`
   - `route('post-detail', '/posts/{id:int}', function ($id) { /* ... */ });`

 - `function  \rounting\route(string $name, array $verbs, string $path, $handler): \Routing\Route;
   - `route('comments', ['GET', 'POST'], '/posts/{id:int}/comments', $handler);`

 - path_type(string $name, string $regexp, $clean_fn): void;    
 - find()
 - link_to()
 - function not_implemented_handler(): void
 - dump_routes()
 - dump_types()
 - debug()