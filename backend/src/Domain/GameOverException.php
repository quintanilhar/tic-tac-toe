<?php

namespace Quintanilhar\TicTacToe\Domain;

class GameOverException extends \Exception
{
    private $winner;

    /**
     * @param string $message
     * @param Player $winner
     * @param Exception $previous
     */
    public function __construct(
        $message,
        Player $winner = null,
        \Exception $previous = null
    ) {
        parent::__construct($message, 0, $previous);

        $this->winner = $winner;
    }

    /**
     * @return boolean
     */
    public function hasWinner()
    {
        return ($this->winner !== null);
    }

    /**
     * @return Player | null
     */
    public function winner()
    {
        return $this->winner;
    }
}
