<?php

namespace Quintanilhar\TicTacToeTests\Integration\Context\Helper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait ApiClient
{
    private $httpClient;

    private $response;

    private function client()
    {
        $this->httpClient = new Client([
            'base_uri' => 'http://webserver/v1/',
            'timeout' => 2.0
        ]); 
    }
}
