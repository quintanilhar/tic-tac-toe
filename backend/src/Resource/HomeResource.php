<?php

namespace Quintanilhar\TicTacToe\Resource;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeResource
{
    public function __invoke(Request $request, Response $response)
    {
        return $response->withJson(
            [
                'resources' => [
                    [
                        'path' => '/moves',
                        'allowedMethods' => ['POST', 'GET']
                    ]
                ]
            ]
        );
    }
}
