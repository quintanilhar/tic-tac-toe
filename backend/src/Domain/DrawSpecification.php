<?php

namespace Quintanilhar\TicTacToe\Domain;

class DrawSpecification
{
    /**
     * @return bool
     */
    public function isSatisfiedBy(Game $game) : bool
    {
        $board = $game->board();

        foreach ($board as $row) {
            $row = array_filter($row);

            if (count($row) < 3) {
                return false;
            }
        }

        return true;
    }
}
