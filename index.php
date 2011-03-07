<?php
set_include_path(getcwd() . DIRECTORY_SEPARATOR . get_include_path());
require 'lib/prggmr.php';
\prggmr::initialize();

\prggmr::listen('dispatch', function($request){
    $uri = 'pages'.$request->uri.'.html';
    $found = false;
    foreach (glob('pages/*') as $_file) {
        if ($_file == $uri) {
            $found = true;
            ob_start();
                include ($_file);
            $page_contents = ob_get_clean();
        }
    }
    if ($found === false) {
        ob_start();
            include ('pages/'.$request->defaultpage.'.html');
        $page_contents = ob_get_clean();
    }
    ob_start();
            include ('comments.php');
        $page_contents .= ob_get_clean();
    include 'template.php';
});

class Request extends \prggmr\Event {}
$request = new Request();
$request->uri = $_SERVER['REQUEST_URI'];
$request->defaultpage = 'index';
$request->dispatch();