<?php

namespace Quintanilhar\TicTacToeTests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Quintanilhar\TicTacToe\Domain\WinnerSpecification;
use Quintanilhar\TicTacToe\Domain\Game;

class WinnerSpecificationTest extends TestCase
{
    private $specification;

    public function setUp()
    {
        $this->specification = new WinnerSpecification();
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedByThreeInTheFirstRow()
    {
        $game = $this->gameOfBoard(
            [
                ['X', 'X', 'X'],
                ['', '', 'O'],
                ['', '', 'O'],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedByThreeInTheSecondRow()
    {
        $game = $this->gameOfBoard(
            [
                ['', '', 'O'],
                ['X', 'X', 'X'],
                ['', '', 'O'],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedByThreeInTheThirdRow()
    {
        $game = $this->gameOfBoard(
            [
                ['', '', 'O'],
                ['', '', 'O'],
                ['X', 'X', 'X'],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedByThreeInTheFirstColumn()
    {
        $game = $this->gameOfBoard(
            [
                ['O', '', 'X'],
                ['O', 'X', 'X'],
                ['O', '', ''],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedByThreeInTheSecondColumn()
    {
        $game = $this->gameOfBoard(
            [
                ['', 'O', 'X'],
                ['X', 'O', 'X'],
                ['', 'O', ''],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedByThreeInTheThirdColumn()
    {
        $game = $this->gameOfBoard(
            [
                ['', 'X', 'O'],
                ['X', 'X', 'O'],
                ['', '', 'O'],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedByThreeInTheLeftDiagonal()
    {
        $game = $this->gameOfBoard(
            [
                ['X', 'O', ''],
                ['O', 'X', ''],
                ['', '', 'X'],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedByThreeInTheRightDiagonal()
    {
        $game = $this->gameOfBoard(
            [
                ['', 'X', 'O'],
                ['', 'O', 'X'],
                ['O', '', 'X'],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldNotBeSatisfied()
    {
        $game = $this->gameOfBoard(
            [
                ['', '', ''],
                ['', '', ''],
                ['', '', 'X'],
            ]
        );

        $this->assertFalse($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldNotBeSatisfiedByDraw()
    {
        $game = $this->gameOfBoard(
            [
                ['X', 'X', 'O'],
                ['O', 'O', 'X'],
                ['X', 'X', 'O'],
            ]
        );

        $this->assertFalse($this->specification->isSatisfiedBy($game));
    }

    private function gameOfBoard(array $board) : Game
    {
        $game = $this->createMock(Game::class);

        $game->method('board')
            ->willReturn($board);

        return $game;
    }
}
