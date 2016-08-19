<?php
namespace Example\User;

use Psr\Http\Message\ResponseInterface;
use Equip\Formatter\JsonFormatter;

class UserResponder
{
    protected $formatter;
    public function __construct(JsonFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function success(ResponseInterface $response, array $output = [])
    {
        return $this
            ->write($response, $output)
            ->withStatus(200);
    }

    public function failure(ResponseInterface $response, array $output = [])
    {
        return $this
            ->write($response, $output)
            ->withStatus(400);
    }

    public function notFound(ResponseInterface $response, array $output = [])
    {
        return $this
            ->write($response, $output)
            ->withStatus(404);
    }

    private function write(ResponseInterface $response, $output)
    {
        $body = $response->getBody();

        $body->write($this->formatter->format($output));

        return $response;
    }
}
