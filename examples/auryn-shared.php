<?php

require_once __DIR__.'/../app/vendor/autoload.php';

class test {}

$injector = new Auryn\Injector;

// new instance
$instance = $injector->make(test::class);
var_dump($instance);

// another new instance
$instance = $injector->make(test::class);
var_dump($instance);

$injector->share($instance);

// the 2nd instance again
$instance = $injector->make(test::class);
var_dump($instance);



$injector = new Auryn\Injector;

// share before the first instance
$injector->share(test::class);

// new instance
$instance = $injector->make(test::class);
var_dump($instance);

// same instance
$instance = $injector->make(test::class);
var_dump($instance);
