<?php

$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];

    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(
        new Monolog\Handler\StreamHandler(
            $settings['path'],
            $settings['level']
        )
    );

    return $logger;
};

$container['move'] = function() {
    return new \Quintanilhar\TicTacToe\Domain\BotMove();
};

$container['moveResource'] = function ($c) {
    return new \Quintanilhar\TicTacToe\Resource\MoveResource($c['move']);
};
