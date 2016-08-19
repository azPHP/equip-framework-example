<?php
namespace Example\User;

use Equip\Contract\ActionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ActionCreateUser implements ActionInterface
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
        $input = $request->getParsedBody();

        // how you handle validation and error handling is up to you
        try
        {
            $user = $this->user->createUser($input);
        }
        catch(\Exception $e)
        {
            return $this->responder->failure($response, ['error' => $e->getMessage()]);
        }

        return $this->responder->success($response, $user->toArray());
    }
}
