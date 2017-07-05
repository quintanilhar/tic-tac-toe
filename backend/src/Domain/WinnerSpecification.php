<?php

namespace Quintanilhar\TicTacToe\Domain;

class WinnerSpecification
{
    private $positions;
    
    public function __construct()
    {
        $this->positions = [
            [new Position(0, 0), new Position(0, 1), new Position(0, 2)], //first row
            [new Position(1, 0), new Position(1, 1), new Position(1, 2)], //second row
            [new Position(2, 0), new Position(2, 1), new Position(2, 2)], //third row
            [new Position(0, 0), new Position(1, 0), new Position(2, 0)], //first column
            [new Position(0, 1), new Position(1, 1), new Position(2, 1)], //second column
            [new Position(0, 2), new Position(1, 2), new Position(2, 2)], //second column
            [new Position(0, 0), new Position(1, 1), new Position(2, 2)], //left diagonal
            [new Position(0, 2), new Position(1, 1), new Position(2, 0)], //right diagonal
        ];
    }

    /**
     * @return bool
     */
    public function isSatisfiedBy(Game $game) : bool
    {
        $board = $game->board();

        foreach ($this->positions as $position) {
            $firstPosition  = $board[$position[0]->row()][$position[0]->column()];
            $secondPosition = $board[$position[1]->row()][$position[1]->column()];
            $thirdPosition  = $board[$position[2]->row()][$position[2]->column()];

            if (empty($firstPosition) || empty($secondPosition) || empty($thirdPosition)) {
                continue;
            }

            if ($firstPosition == $secondPosition &&
                $secondPosition == $thirdPosition &&
                $thirdPosition == $firstPosition
            ) {
                return true;
            } 
        }

        return false;
    }
}
