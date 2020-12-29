<?php

include "vendor/autoload.php";

use function routing\route;
use function routing\find;
use function routing\debug;

route('/');
route('/posts');
route('/posts/{name:str}');

$r = find($_SERVER['REQUEST_URI']);
if ($r->getRoute()) {
    call_user_func($r->getRoute()->getCallback());
} else {
    http_response_code(403);
    echo 'Bad Request';
    debug();
}