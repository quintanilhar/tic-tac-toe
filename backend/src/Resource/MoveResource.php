<?php

namespace Quintanilhar\TicTacToe\Resource;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Quintanilhar\TicTacToe\Domain;

class MoveResource
{
    private $move;

    public function __construct(MoveInterface $move)
    {
        $this->move = $move;
    }

    public function __invoke(Request $request, Response $response)
    {
        return $response->withJson($this->move->makeMove());
    }
}
