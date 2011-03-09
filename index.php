<?php
set_include_path(getcwd() . DIRECTORY_SEPARATOR . get_include_path());
require 'lib/prggmr.php';
\prggmr::initialize();

define('WEB_URL', 'http://prggmr-docs');

function plink($uri) {
    return WEB_URL.$uri;
}

\prggmr::listen('dispatch', function($request){
    $uri = 'pages'.$request->uri.'.php';
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
            include ('pages/'.$request->defaultpage.'.php');
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