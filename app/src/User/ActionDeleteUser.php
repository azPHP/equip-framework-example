<?php
namespace Example\User;

use Equip\Contract\ActionInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ActionDeleteUser implements ActionInterface
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
        $input = $request->getAttributes();

        // how you handle validation and error handling is up to you
        if (empty($input['username']))
        {
            return $this->responder->failure($response, ['error' => 'username is required']);
        }
        try
        {
            $user = $this->user->deleteUser($input['username']);
            if ($user === null)
            {
                return $this->responder->notFound($response, ['msg' => "$input[username] not found"]);
            }
        }
        catch(\Exception $e)
        {
            return $this->responder->failure($response, ['error' => $e->getMessage()]);
        }

        $out = ['status' => 'deleted', 'user' => $user->toArray()];
        return $this->responder->success($response, $out);
    }
}
