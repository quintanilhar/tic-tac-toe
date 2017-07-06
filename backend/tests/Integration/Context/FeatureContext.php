<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\Assert;
use Quintanilhar\TicTacToeTests\Integration\Context\Helper\ApiClient;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    const BOT_TEAM = 'X';

    private $client;

    private $boardState = [];

    private $turns = [];

    private $response;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    /**
     * @Then the response code should be :code
     */
    public function theResponseCodeShouldBe($code)
    {
        Assert::assertEquals($code, $this->response->getStatusCode());
    }

    /**
     * @Then the response should contain ":text"
     */
    public function theResponseShouldContain($text)
    {
        Assert::assertRegExp(
            '/' . preg_quote($text) . '/i',
            (string)$this->response->getBody()
        );
    }

    /**
     * @Then The game state should be:
     */
    public function theGameStateShouldBe(TableNode $table)
    {
        $expectedBoard = [];
        foreach ($table->getTable() as $index => $row) {
            $expectedBoard[] = $row;
        }

        $output = null;
        foreach ($this->boardState as $row) {
            $output .= "| " . implode(' | ', $row) . " |\n";
        } 

        Assert::assertSame($expectedBoard, $this->boardState, $output);
    }

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
     * @When I request for the next bot move
     */
    public function iRequestForTheNextBotMove()
    {
        $this->response = $this->client->postMove(self::BOT_TEAM, $this->boardState);

        $move = json_decode((string)$this->response->getBody(), true);

        if (isset($move['x']) && isset($move['y'])) {
            $this->boardState[$move['x']][$move['y']] = self::BOT_TEAM;
        }
    }

    /**
     * @Given the following turns:
     */
    public function theFollowingTurns(TableNode $turnsTable)
    {
        foreach ($turnsTable->getHash() as $turn) {
            $this->turns[$turn['turn']] = $turn;
        }
    }

    /**
     * @When I request the game status
     */
    public function iRequestTheGameStatus()
    {
        $this->response = $this->client->postGame($this->turns);

        $this->boardState = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];

        $payload = json_decode((string)$this->response->getBody(), true);

        if (isset($payload['board'])) {
            $this->boardState = $payload['board'];
        }
    }

    /**
     * @Then the status should be :status
     */
    public function theStatusShouldBe($status)
    {
        $payload = json_decode((string)$this->response->getBody(), true);

        Assert::assertEquals($status, $payload['status']);
    }
}
