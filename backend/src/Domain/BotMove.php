<?php

namespace Quintanilhar\TicTacToe\Domain;

class BotMove implements MoveInterface
{
    /**
     * @param array $boardState Current board state
     * @param string $playerUnit Player unit representation
     *
     * @return array
     */
    public function makeMove($boardState, $playerUnit = 'X') : array
    {
        foreach ($boardState as $rowNumber => $row) {
            foreach ($row as $columnNumber => $column) {
                if (!empty($column)) {
                    continue;
                }

                return [$rowNumber, $columnNumber, $playerUnit];
            }
        }

        throw new GameOverException('The bot can not make a move.');
    }
}
