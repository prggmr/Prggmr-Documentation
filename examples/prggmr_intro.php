<?php
require 'bootstrap.php';

// Subscribe to an event
\prggmr::listen('event_name', function($event, $name){
    // Action to take
    echo $name;
});

// Publish an event
\prggmr::trigger('event_name', array('nick'));