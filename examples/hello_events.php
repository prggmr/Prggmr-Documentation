<?php
require 'bootstrap.php';

// Subscribe to the "hello_world" event.
prggmr::listen('hello_world', function(){
   echo 'Hello World!'; 
});

// Publish the "hello_world" event.
prggmr::trigger('hello_world');