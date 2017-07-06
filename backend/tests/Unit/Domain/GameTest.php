<?php

namespace Quintanilhar\TicTacToeTests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Quintanilhar\TicTacToe\Domain\Game;
use Quintanilhar\TicTacToe\Domain\Player;
use Quintanilhar\TicTacToe\Domain\Position;
use Quintanilhar\TicTacToe\Domain\GameOverException;

class GameTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldStartTheGame()
    {
        $game = new Game();

        $expectedBoard = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $this->assertEquals($expectedBoard, $game->board());
        $this->assertEquals(0, $game->turn());
    }

    /**
     * @test
     */
    public function itShouldMakeAPlayerMove()
    {
        $game = new Game();

        $expectedBoard = [
            ['', '', ''],
            ['', '', ''],
            ['', '', 'X'],
        ];

        $game->moveOf(
            Player::playerOfXTeam(),
            new Position(2, 2)
        );

        $this->assertEquals($expectedBoard, $game->board());
        $this->assertEquals(1, $game->turn()); 
    }

    /**
     * @test
     */
    public function itShouldMarkPlayerOfXTeamAsWinner()
    {
        $game = new Game();

        $expectedBoard = [
            ['X', 'O', 'O'],
            ['', 'X', ''],
            ['', '', 'X'],
        ];

        $game->moveOf(Player::playerOfXTeam(), new Position(2, 2));
        $game->moveOf(Player::playerOfOTeam(), new Position(0, 2));
        $game->moveOf(Player::playerOfXTeam(), new Position(1, 1));
        $game->moveOf(Player::playerOfOTeam(), new Position(0, 1));

        try {
            $game->moveOf(Player::playerOfXTeam(), new Position(0, 0));
            $this->fail('Expects a GameOverException.');
        } catch (GameOverException $e) {
            $this->assertEquals($expectedBoard, $game->board());
            $this->assertEquals(5, $game->turn()); 
            $this->assertEquals(Player::playerOfXTeam(), $e->winner());
        }
    }

    /**
     * @test
     * @expectedException Quintanilhar\TicTacToe\Domain\GameOverException
     * @expectedExceptionMessage Can't make the given move, the game has already over
     */
    public function itShouldNotMakeAMoveForGameOver()
    {
        $game = new Game();

        $expectedBoard = [
            ['X', 'O', 'O'],
            ['', 'X', ''],
            ['', '', 'X'],
        ];

        $game->moveOf(Player::playerOfXTeam(), new Position(2, 2));
        $game->moveOf(Player::playerOfOTeam(), new Position(0, 2));
        $game->moveOf(Player::playerOfXTeam(), new Position(1, 1));
        $game->moveOf(Player::playerOfOTeam(), new Position(0, 1));

        try {
            $game->moveOf(Player::playerOfXTeam(), new Position(0, 0));
        } catch (GameOverException $e) {
            $game->moveOf(Player::playerOfOTeam(), new Position(0, 0));
        }
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The position 0,0 is already filled by X team
     */
    public function itShouldThrowExceptionWhenMoveOfSomePositionWasGiven()
    {
        $game = new Game();

        $game->moveOf(Player::playerOfXTeam(), new Position(0, 0));
        $game->moveOf(Player::playerOfOTeam(), new Position(0, 0));
    }
}
