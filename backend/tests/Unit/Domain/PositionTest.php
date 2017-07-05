<?php

namespace Quintanilhar\TicTacToeTests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Quintanilhar\TicTacToe\Domain\Position;

class PositionTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreateAPosition()
    {
        $position = new Position(0, 0);

        $this->assertInstanceOf(Position::class, $position);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Row is invalid
     */
    public function itShouldThrowExceptionWhenInvalidRowWasGiven()
    {
        new Position(3, 0);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Column is invalid
     */
    public function itShouldThrowExceptionWhenInvalidColumnWasGiven()
    {
        new Position(1, -1);
    }
}
