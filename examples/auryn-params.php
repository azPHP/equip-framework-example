<?php

require_once __DIR__.'/../app/vendor/autoload.php';

class test
{
    public $foobar;

    public function __construct($foobar) { $this->foobar = $foobar;}
}


$injector = new Auryn\Injector;
try
{
    $instance = $injector->make(test::class);
}
catch(Exception $e)
{
    echo $e->getMessage()."\n";
}

$injector = new Auryn\Injector;
$injector->define(test::class, [':foobar' => 'woot']);
$instance = $injector->make(test::class);

var_dump($instance->foobar);
