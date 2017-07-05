Feature: Game playing
    As a player
    I want to know when the game ends

    Scenario: The player of X team wins
        Given the board state is:
            | X |   | O |
            |   | X | O |
            |   |   | X |
        When request the game status
        Then the response code should be "200"
        And the winner is the "X" team
