<?php

namespace Quintanilhar\TicTacToeTests\Integration\Context\Helper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiClient
{
    private $client;

    public function __construct()
    {
        if ($this->client === null) {
            $this->client = new Client([
                'base_uri' => 'http://webserver/v1/',
                'timeout' => 2.0
            ]);
        }

        return $this->client;
    }

    public function postGame(array $turns)
    {
        try {
            return $this->client->request('POST', 'games', [
                'json' => [
                    'turns' => $turns
                ]
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
        }
    }

    public function postMove($botTeam, $boardState)
    {
        try {
            return $this->client->request('POST', sprintf('bots/%s/moves', $botTeam), [
                'json' => [
                    'board' => $boardState
                ]
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
        }
    }
}
