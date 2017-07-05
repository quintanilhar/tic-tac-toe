<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class GameContext implements Context
{
    /**
     * @When request the game status
     */
    public function requestTheGameStatus()
    {
        throw new PendingException();
    }

    /**
     * @Then the winner is the :arg1 team
     */
    public function theWinnerIsTheTeam($arg1)
    {
        throw new PendingException();
    }
}
