<?php

namespace Quintanilhar\TicTacToe\Resource;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Quintanilhar\TicTacToe\Domain\MoveInterface;
use Quintanilhar\TicTacToe\Domain\GameOverException;

class MoveResource
{
    private $move;

    public function __construct(MoveInterface $move)
    {
        $this->move = $move;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();

        try {
            $move = $this->move->makeMove(
                $body['board'],
                $args['team']
            );
        } catch (\InvalidArgumentException $e) {
            return $response->withStatus(400)
                ->withJson(
                    [
                        'validation_errors' => [
                            'board' => $e->getMessage()
                        ]
                    ]
                );
        } catch (GameOverException $e) {
            return $response->withStatus(422)
                ->withJson(
                    [
                        'validation_errors' => [
                            'board' => 'Game over: ' . $e->getMessage()
                        ]
                    ]
                );
        }

        return $response->withJson(
            [
                'x' => $move[0],
                'y' => $move[1]
            ]
        );
    }
}
