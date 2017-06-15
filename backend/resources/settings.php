<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Monolog settings
        'logger' => [
            'name' => 'tictactoe',
            'path' => 'php://stdout',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
