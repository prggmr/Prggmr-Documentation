<?php
require 'bootstrap.php';
// Subscribe to the "hello world" event.
prggmr::listen('hello world', function(){
   echo 'hello world';
});

// Publish the "hello world" event.
prggmr::trigger('hello world');