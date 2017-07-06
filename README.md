
```

2- Go to project folder:
```shell
cd tic-tac-toe
```

3- Start the application:
```shell
./bin/run-app.sh
```
> Note: this command will up two applications, frontend and backend, and it may 
spend some time to complete if you are running for the first time because it 
will download the docker images from Docker Hub.

4- Access the bellow address in your browser:
```shell
http://localhost:5020
```

> Note: the API (backend) is running on port 5010 and can be requested at 
http://localhost:5010.

## API Resources

### /v1/{team}/moves
Resource to take the next bot move based on the given board.

Request:
```shell
POST http://localhost:5010/v1/X/moves

Content-Type: application/json
{
    "board": [ 
        ["O", "X", "X"],
        ["", "", ""],
        ["", "O", ""]
    ]
} 
```

Response:
```shell
200 OK

{"x":1,"y":0}

```

### /v1/games
Resource to take the game status.

Request:
```shell
POST http://localhost:5010/v1/games

Content-Type: application/json
{
    "turns": [
        {
            "team": "X",
            "row": 0,
            "column": 0
        },
        {
            "team": "O",
            "row": 1,
            "column": 1
        }
    ]
}
```

Response when the game has not ended yet:
```shell
204 No Content

```

Response when the game ends with a winner:
```shell
200 Ok

{
    "status": "gameover",
    "board" : [
        ["X", "X", "X"],
        ["", "", ""],
        ["", "O", "O"]
    ],
    "message": "The X team won!"
}

```

Response when the game ends in a draw:
```shell
200 Ok

{
    "status": "gameover",
    "board" : [
        ["X", "O", "X"],
        ["X", "O", "X"],
        ["O", "X", "O"]
    ],
    "message": "Draw game"
}

```

## Running the tests

* **Unit tests** - run the command:

```shell
./bin/run-unit-tests.sh

```

* **Integration tests** - run the command:

```shell
./bin/run-integration-tests.sh
```

## Built With

### Backend

* [Slim](https://www.slimframework.com/docs/) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management
* [Monolog](https://seldaek.github.io/monolog/) - Logger tool

### Frontend

* [JQuery](https://jquery.com/) - The Javascript library
* [PureCSS](https://purecss.io/) - The CSS library

## Authors

* **Ricardo Quintanilha** - [quintanilhar](https://github.com/quintanilhar)
