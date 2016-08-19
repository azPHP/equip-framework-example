<?php

require_once __DIR__.'/../app/vendor/autoload.php';

class bar {}
class foo extends bar {}

class test
{
    public $foobar;

    public function __construct(bar $foobar) { $this->foobar = $foobar;}
}


$injector = new Auryn\Injector;
$instance = $injector->make(test::class);
var_dump(get_class($instance->foobar));

$injector = new Auryn\Injector;
$injector->alias('bar', 'foo');
$instance = $injector->make(test::class);

var_dump(get_class($instance->foobar));
