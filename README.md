# Tic Tac Toe Game

A PHP implementation of Tic Tac Toe game.

## Getting Started

### Prerequisites

Before start, you must have installed in your machine the following tools:

* [Docker](https://docs.docker.com/engine/installation/) - version >=17.0
* [Docker Compose](https://docs.docker.com/compose/install/) - version >=13.0
* [Git](https://git-scm.com/)


### Installing

Follow the steps bellow to get the development/testing environment up and running:


1- Clone this repository:

```shell
git clone https://github.com/quintanilhar/tic-tac-toe.git

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

5- Make a POST request to the move resource:

Example:
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

The expected response should be:
```shell
200 OK

{"x":1,"y":0}

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
