<?php

namespace Quintanilhar\TicTacToe\Domain;

final class Player
{
    const X_TEAM = 'X';
    const O_TEAM = 'O';

    private $team;

    /**
     * @param string $team
     */
    private function __construct(string $team)
    {
        $this->team = $team;
    }

    /**
     * @return string
     */
    public function team()
    {
        return $this->team;
    }

    /**
     * Create a Player of the X Team.
     *
     * @return Player
     */
    public static function playerOfXTeam()
    {
        return new self(self::X_TEAM);
    }

    /**
     * Create a Player of the O Team.
     *
     * @return Player
     */
    public static function playerOfOTeam()
    {
        return new self(self::O_TEAM);
    }
}
