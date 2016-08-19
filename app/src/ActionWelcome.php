<?php
namespace Example;

use Equip\Contract\ActionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

// Output for our domainless page /
class ActionWelcome implements ActionInterface
{
    protected $responder;

    public function __construct(StaticResponder $responder)
    {
        $this->responder = $responder;
        $this->responder->file = __DIR__.'/../templates/home.php';
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->responder->success($response);
    }
}
