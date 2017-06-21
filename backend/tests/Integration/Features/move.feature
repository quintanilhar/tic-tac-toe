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
        Then The game state should be:
            | X |   |   |
            |   |   |   |
            |   |   |   |
