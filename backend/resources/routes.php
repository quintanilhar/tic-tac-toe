<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Quintanilhar\TicTacToe\Resource;

$app->group('/v1', function() use ($container) {
    $this->post('/{team}/moves', $container['moveResource'])
        ->add(Resource\PostRequestValidationMiddleware::class);

    $this->post('/games', $container['gameResource']);
});
