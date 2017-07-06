<?php

namespace Quintanilhar\TicTacToeTests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Quintanilhar\TicTacToe\Domain\DrawSpecification;
use Quintanilhar\TicTacToe\Domain\Game;

class DrawSpecificationTest extends TestCase
{
    private $specification;

    public function setUp()
    {
        $this->specification = new DrawSpecification();
    }

    /**
     * @test
     */
    public function itShouldBeSatisfiedBy()
    {
        $game = $this->gameOfBoard(
            [
                ['X', 'O', 'X'],
                ['X', 'O', 'X'],
                ['O', 'X', 'O'],
            ]
        );

        $this->assertTrue($this->specification->isSatisfiedBy($game));
    }

    /**
     * @test
     */
    public function itShouldNotBeSatisfiedBy()
    {
        $game = $this->gameOfBoard(
            [
                ['X', 'O', 'X'],
                ['X', 'O', 'X'],
                ['O', '', 'O'],
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
