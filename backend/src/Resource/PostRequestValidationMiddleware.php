<?php

namespace Quintanilhar\TicTacToe\Resource;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PostRequestValidationMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $body = $request->getParsedBody();

        if (empty($body) ||
            !isset($body['board']) ||
            !is_array($body['board']) ||
            empty($body['board'])
        ) {
            return $this->prepareResponse($response, [
                'board' => 'The field board is required and can\'t be blank'
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
