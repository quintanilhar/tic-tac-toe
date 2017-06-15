<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Quintanilhar\TicTacToe\Resource\HomeResource;

$app->get('/', HomeResource::class);
