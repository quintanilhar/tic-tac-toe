<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    const PLAYER_UNIT = 'X';

    private $boardState;

    /**
     * @Given the board state is:
     */
    public function theBoardStateIs(TableNode $table)
    {
        foreach ($table->getTable() as $row) {
            $this->boardState[] = $row;
        }
    }

    /**
     * @When I ask for the next move
     */
    public function iAskForTheNextMove()
    {
        //API CALL
        $this->move = [
            'x' => 0,
            'y' => 0
        ];
    }

    /**
     * @Then The game state should be:
     */
    public function theGameStateShouldBe(TableNode $table)
    {
        $this->boardState[$this->move['x']][$this->move['y']] = self::PLAYER_UNIT;

        $expectedBoard = [];
        foreach ($table->getTable() as $index => $row) {
            $expectedBoard[] = $row;
        }

        $output = null;
        foreach ($this->boardState as $row) {
            $output .= "| " . implode(' | ', $row) . " |\n";
        } 

        Assert::assertSame($this->boardState, $expectedBoard, $output);
    }
}
