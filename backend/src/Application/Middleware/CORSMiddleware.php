<?php

namespace Quintanilhar\TicTacToe\Application\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CORSMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $response = $next($request, $response);

        return $response->withHeader('Access-Control-Allow-Origin', 'http://localhost:5020')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type');
    }
}
