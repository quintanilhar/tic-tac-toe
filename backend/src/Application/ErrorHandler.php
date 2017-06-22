<?php

namespace Quintanilhar\TicTacToe\Application;

use Psr\Log\LoggerInterface;
use Slim\Handlers\Error;

class ErrorHandler extends Error
{
    use WriteLogErrorHandlerTrait;

    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
