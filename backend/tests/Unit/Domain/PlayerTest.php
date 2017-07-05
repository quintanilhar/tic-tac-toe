<?php

namespace Quintanilhar\TicTacToeTests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Quintanilhar\TicTacToe\Domain\Player;

class PlayerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreatePlayerOfXTeam()
    {
        $player = Player::playerOfXTeam();

        $this->assertEquals(Player::X_TEAM, $player->team());
    }

    /**
     * @test
     */
    public function itShouldCreatePlayerOfOTeam()
    {
        $player = Player::playerOfOTeam();

        $this->assertEquals(Player::O_TEAM, $player->team());
    }
}
