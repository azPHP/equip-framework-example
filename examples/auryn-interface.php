<?php

require_once __DIR__.'/../app/vendor/autoload.php';

interface foo {}

class bar implements foo {}

class test
{
    public function __construct(foo $foobar) {}
}


$injector = new Auryn\Injector;

// doesn't work because you can't create an instance of an interface
try
{
    $instance = $injector->make(test::class);
}
catch(Exception $e)
{
    echo $e->getMessage()."\n";
}

$injector = new Auryn\Injector;
$injector->alias('foo', 'bar');
$instance = $injector->make(test::class);

var_dump(get_class($instance));
