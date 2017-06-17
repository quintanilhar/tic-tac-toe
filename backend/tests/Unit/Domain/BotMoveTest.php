<?php

namespace Quintanilhar\TicTacToeTests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Quintanilhar\TicTacToe\Domain\BotMove;

class BotMoveTest extends TestCase
{
    private $move;

    public function setUp()
    {
        $this->move = new BotMove();
    }

    /**
     * @test
     */
    public function itShouldMakeTheFirstMove()
    {
        $boardState = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $expected = [0, 0, 'X'];

        $this->assertEquals($expected, $this->move->makeMove($boardState, 'X'));
    }

    /**
     * @test
     */
    public function itShouldMakeItMove()
    {
        $boardState = [
            ['X', 'O', 'O'],
            ['', '', ''],
            ['', '', ''],
        ];

        $expected = [1, 0, 'X'];

        $this->assertEquals($expected, $this->move->makeMove($boardState, 'X'));
    }

    /**
     * @test
     * @expectedException Quintanilhar\TicTacToe\Domain\GameOverException
     */
    public function itShouldThrowGameOverException()
    {
        $boardState = [
            ['X', 'O', 'O'],
            ['O', 'X', 'X'],
            ['O', 'X', 'O'],
        ];

        $this->move->makeMove($boardState, 'X');
    }
}
