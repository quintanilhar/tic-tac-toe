<?php

namespace Quintanilhar\TicTacToe\Domain;

use InvalidArgumentException;

class Game
{
    private $board;

    private $turn;

    private $isOver = false;

    private $winner = null;
   
    public function __construct()
    {
        $this->board = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $this->turn = 0;
    }

    /**
     * @return array
     */
    public function board()
    {
        return $this->board;
    }

    /**
     * @return int
     */
    public function turn()
    {
        return $this->turn;
    }

    /**
     * @param Player $player
     * @param Position $position
     * @return void
     * @throws GameOverException
     */
    public function moveOf(Player $player, Position $position)
    {
        if ($this->isOver === true) {
            throw new GameOverException(
                'Can\'t make the given move, the game has already over',
                $this->winner
            );
        }

        $team = $this->board[$position->row()][$position->column()];
        
        if (!empty($team)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The position %d,%d is already filled by %s team',
                    $position->row(),
                    $position->column(),
                    $team
                )
            );
        } 

        $this->board[$position->row()][$position->column()] = $player->team();  
        $this->turn++;

        if ($this->hasWinner()) {
            $this->isOver = true;
            $this->winner = $player;

            throw new GameOverException(
                sprintf('The %s team won!', $player->team()),
                $player
            );
        }
    }

    /**
     * @return bool
     */
    private function hasWinner() : bool
    {
        $winnerSpecification = new WinnerSpecification();
        return $winnerSpecification->isSatisfiedBy($this);
    }
}
