<?php
set_include_path(getcwd() . DIRECTORY_SEPARATOR . get_include_path());
require 'lib/prggmr.php';
\prggmr::initialize();

define('WEB_URL', 'http://prggmr-docs');

function plink($uri) {
    return WEB_URL.$uri;
}

// Recursilvy build our file listing
function buildFileArray($dir) {
    $return = array();
    $it = new DirectoryIterator($dir);
    foreach ($it as $fileinfo) {
        if ($found) break;
        if ($fileinfo->isFile()) {
            $return[$dir.'/'.$fileinfo->getFilename()] = true;
        } elseif ($fileinfo->isDir() && !$fileinfo->isDot()) {
            $array = buildFileArray($dir.'/'.$fileinfo->getFileName());
            foreach ($array as $_k => $_f) {
                $return[$_k] = true;
            }
        }
    }
    return $return;
}

\prggmr::listen('dispatch', function($request) {
    
    $uri = 'pages'.$request->uri.'.php';
    $found = false;
    $fileArray = buildFileArray('pages');

    foreach ($fileArray as $_file => $_v) {
        if ($_file == $uri) {
            $found = true;
            ob_start();
                include ($_file);
            $page_contents = ob_get_clean();
            break;
        }
    }

    if (!$found) {
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