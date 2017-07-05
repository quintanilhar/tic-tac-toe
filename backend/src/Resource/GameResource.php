<?php

namespace Quintanilhar\TicTacToe\Resource;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Quintanilhar\TicTacToe\Domain\Game;
use Quintanilhar\TicTacToe\Domain\Player;
use Quintanilhar\TicTacToe\Domain\Position;
use Quintanilhar\TicTacToe\Domain\GameOverException;

class GameResource
{
    private $game;
    private $players = [];

    public function __construct(Game $game)
    {
        $this->game = $game;

        $this->players = [
            Player::X_TEAM => Player::playerOfXTeam(),
            Player::O_TEAM => Player::playerOfOTeam(),
        ];
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();

        try {
            foreach ($body['turns'] as $turn) {
                $this->game->moveOf(
                    $this->players[$turn['team']],
                    new Position($turn['row'], $turn['column'])
                );
            }

            return $response->withStatus(204);

        } catch (GameOverException $e) {
            return $response->withJson(
                [
                    'status'    => 'gameover',
                    'message'   => $e->getMessage(),
                    'board'     => $this->game->board()
                ]
            );
        }
    }
}
