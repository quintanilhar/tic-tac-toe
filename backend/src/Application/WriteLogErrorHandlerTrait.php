<?php

namespace Quintanilhar\TicTacToe\Application;

trait WriteLogErrorHandlerTrait
{
    /**
     * Write to the error log if displayErrorDetails is false
     *
     * @param \Exception|\Throwable $throwable
     *
     * @return void
     */
    protected function writeToErrorLog($throwable)
    {
        $message = $this->renderThrowableAsText($throwable);

        $this->logger->error($message);
    }
}
