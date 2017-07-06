<?php

namespace Quintanilhar\TicTacToe\Resource;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GameRequestValidationMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $body = $request->getParsedBody();

        if (empty($body) ||
            !isset($body['turns']) ||
            !is_array($body['turns']) ||
            empty($body['turns'])
        ) {
            return $this->prepareResponse($response, [
                'turns' => 'The field turns is required and can\'t be blank'
            ]);
        }

        foreach ($body['turns'] as $turn) {
            if (array_key_exists('team', $turn) &&
                array_key_exists('row', $turn) &&
                array_key_exists('column', $turn)) {
                continue;
            }

            return $this->prepareResponse($response, [
                'turns' => 'Invalid item(s) in turns field'
            ]);
        }

        return $next($request, $response);
    }

    /**
     * Prepare a response object for validation errors.
     *
     * @param Response $response
     * @param array $validationErrors
     *
     * @return Response
     */
    private function prepareResponse(
        Response $response,
        array $validationErrors
    ) : Response {
        return $response->withStatus(400)
            ->withJson([
                'validation_errors' => $validationErrors
            ]);
    }
}
