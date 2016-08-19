<?php
namespace Example\User;

use Equip\Contract\ActionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ActionListUsers implements ActionInterface
{
    protected $responder;
    protected $user;

    public function __construct(UserResponder $responder, UserDomain $user)
    {
        $this->responder = $responder;
        $this->user = $user;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $users = array_values($this->user->listUsers());

        return $this->responder->success($response, $users);
    }
}
