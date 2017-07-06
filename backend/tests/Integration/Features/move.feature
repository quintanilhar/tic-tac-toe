Feature: Bot moves
    In order to play Tic Tac Toe
    As a player
    I want to play a game with a bot

    Scenario: Start the game
        Given the board state is:
            |   |   |   |
            |   |   |   |
            |   |   |   |
        When I request for the next bot move
        Then the response code should be "200"
        And the game state should be:
            | X |   |   |
            |   |   |   |
            |   |   |   |

    Scenario: Empty payload
        When I request for the next bot move
        Then the response code should be "400"
        And the response should contain "The field board is required"

    Scenario: Invalid payload schema
        Given the board state is:
            |   |   |   |
        When I request for the next bot move
        Then the response code should be "400"
        And the response should contain "The field board is invalid"

    Scenario: Game over
        Given the board state is:
            | X | O | O |
            | O | O | X |
            | X | X | O |
        When I request for the next bot move
        Then the response code should be "422"
        And the response should contain "The bot can not make a move"
