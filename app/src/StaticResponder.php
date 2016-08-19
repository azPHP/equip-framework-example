<?php
namespace Example;

use Psr\Http\Message\ResponseInterface;

// Plates is supported if you want a real template engine
// http://platesphp.com/
class StaticResponder
{
    public $file;

    public function success(ResponseInterface $response, array $output = [])
    {
        ob_start();
        include $this->file;
        $output = ob_get_contents();
        ob_end_clean();

        return $this
            ->write($response, $output)
            ->withStatus(200);
    }

    private function write(ResponseInterface $response, $output)
    {
        $body = $response->getBody();

        $body->write($output);

        return $response;
    }

}
