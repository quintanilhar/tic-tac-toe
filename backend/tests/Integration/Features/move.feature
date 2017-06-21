Feature: Bot makes a move
    As a developer
    I need an resource to get the next bot move
    So that I can play with it.

    Scenario: Bot starts the game
        Given the board state is:
            |   |   |   |
            |   |   |   |
            |   |   |   |
        When I ask for the next move
        Then The game state should be:
            | X |   |   |
            |   |   |   |
            |   |   |   |
