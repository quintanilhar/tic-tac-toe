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
    public function makeMove(array $boardState, string $playerUnit = 'X') : array
    {
        $this->validateBoard($boardState);

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

    /**
     * Validate if the given board is a matrix of 3x3.
     *
     * @param array $board
     * @throws InvalidArgumentException
     */
    private function validateBoard(array $board)
    {
        $message = 'The field board is invalid, it must be a 3x3 matrix.'; 

        if (count($board) !== 3) {
            throw new \InvalidArgumentException($message);
        }

        foreach ($board as $row) {
            if (count($row) === 3) {
                continue;
            }

            throw new \InvalidArgumentException($message);
        }
    }
}
