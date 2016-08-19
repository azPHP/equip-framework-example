<?php

require_once __DIR__.'/../app/vendor/autoload.php';

class foo {}
class bar extends foo {}

$injector = new Auryn\Injector;

// we can just use a closure, and use, to copy in any dependencies we need
$classname = 'bar';
$injector->delegate(foo::class, function() use($classname) {
    return new $classname;
});
$instance = $injector->make(foo::class);
var_dump($instance);

// we can make a callable to make that concrete
class factory
{
    public $classname = 'bar';
    public function __invoke()
    {
        return new $this->classname;
    }
}
$injector = new Auryn\Injector;
$injector->delegate(foo::class, factory::class);
$instance = $injector->make(foo::class);
var_dump($instance);


// if we needed the injector to make our instances we could ask for it
class factory2
{
    public $classname = 'bar';
    protected $injector;
    public function __construct(Auryn\Injector $injector)
    {
        $this->injector = $injector;
    }
    public function __invoke()
    {
        return $this->injector->make($this->classname);
    }
}
$injector = new Auryn\Injector;
$injector->delegate(foo::class, factory2::class);
$instance = $injector->make(foo::class);
var_dump($instance);
