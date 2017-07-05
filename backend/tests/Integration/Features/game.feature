Feature: Game playing
    As a player
    I want to know when the game ends

    Scenario: The player of X team wins
        Given the following turns:
            | turn | team | row | column | 
            | 0    | X    | 0   | 0      |
            | 1    | O    | 2   | 2      |
            | 2    | X    | 0   | 1      |
            | 3    | O    | 2   | 1      |
            | 4    | X    | 0   | 2      |
        When request the game status
        Then the response code should be "200"
        And the game state should be:
            | X | X | X |
            |   |   |   |
            |   | O | O |
        And the status should be "gameover"
        And the response should contain "The X team won!"

    Scenario: The player of O team wins
        Given the following turns:
            | turn | team | row | column | 
            | 0    | X    | 0   | 0      |
            | 1    | O    | 2   | 2      |
            | 2    | X    | 1   | 1      |
            | 3    | O    | 2   | 1      |
            | 4    | X    | 0   | 2      |
            | 5    | O    | 2   | 0      |
        When request the game status
        Then the response code should be "200"
        And the game state should be:
            | X |   | X |
            |   | X |   |
            | O | O | O |
        And the status should be "gameover"
        And the response should contain "The O team won!"

    Scenario: The game continue
        Given the following turns:
            | turn | team | row | column | 
            | 0    | X    | 0   | 0      |
            | 1    | O    | 2   | 2      |
            | 2    | X    | 1   | 1      |
        When request the game status
        Then the response code should be "204"
