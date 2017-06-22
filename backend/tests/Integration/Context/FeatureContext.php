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
class FeatureContext implements Context
{
    const BOT_TEAM = 'X';

    const API_ENDPOINT = 'http://webserver/v1/';

    private $boardState = [];

    private $httpClient;

    private $response;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => self::API_ENDPOINT,
            'timeout' => 2.0
        ]); 
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
        try {
            $this->response = $this->httpClient->request('POST', self::BOT_TEAM .'/moves', [
                'json' => [
                    'board' => $this->boardState
                ]
            ]); 
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->response = $e->getResponse();
            }
        }
    }

    /**
     * @Then The game state should be:
     */
    public function theGameStateShouldBe(TableNode $table)
    {
        $move = json_decode((string)$this->response->getBody(), true);

        $this->boardState[$move['x']][$move['y']] = self::BOT_TEAM;

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
}
