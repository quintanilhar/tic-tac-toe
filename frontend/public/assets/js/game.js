var Game = function () {
};

Game.prototype = {
    constructor: Game,
    humanTeam: 'X',
    botTeam: 'O',

    registerEvents: function (game) {
        $('.board-cell')
            .filter(function() {
                return !$(this).find('input').val();
            })
            .on('click', function(e) {
                try {
                    game.move(
                        $(this).data('row'),
                        $(this).data('column'),
                        game.humanTeam
                    );

                    $(this).unbind('click');

                    game.requestBotMove(game);
                 } catch (err) {
                    if (err.name == 'gameOver') {
                        game.writeMessage(err.message);
                        game.removeEvents();
                    } 
                 }
            });

    },

    registerRestartEvent: function (game) {
        $('.restart').on('click', function() {
            var cell = $('.board-cell');
            
            cell.find('input').val('');
            cell.contents().filter(function(){ return this.nodeType != 1; }).remove();

            $('.message p').remove();

            game.removeEvents();
            game.registerEvents(game);
        });
    },

    removeEvents: function () {
        $('.board-cell').unbind('click');
    },

    move: function (xCoordinate, yCoordinate, team) {
        $('input[name="board[' + xCoordinate + '][' + yCoordinate + ']"]')
            .val(team)
            .parent()
            .append(team);

        this.validateGameOver();
    },

    boardState: function () {
        board = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];

        $('.board-cell').each(function (index, item) {
            board[$(this).data('row')][$(this).data('column')] = $(this).find('input').val();
        });

        return board;
    },

    validateGameOver: function () {
        
        var board = this.boardState(); 

        var winnerStates = [
            // Rows
            [{x: 0, y: 0}, {x: 0, y: 1}, {x: 0, y: 2}],
            [{x: 1, y: 0}, {x: 1, y: 1}, {x: 1, y: 2}],
            [{x: 2, y: 0}, {x: 2, y: 1}, {x: 2, y: 2}],

            //Columns
            [{x: 0, y: 0}, {x: 1, y: 0}, {x: 2, y: 0}],
            [{x: 0, y: 1}, {x: 1, y: 1}, {x: 2, y: 1}],
            [{x: 0, y: 2}, {x: 1, y: 2}, {x: 2, y: 2}],

            // Diagonals
            [{x: 0, y: 0}, {x: 1, y: 1}, {x: 2, y: 2}],
            [{x: 0, y: 2}, {x: 1, y: 1}, {x: 2, y: 0}],
        ];

        var winner = null;

        $.each(winnerStates, function (index, state) {
            if (board[state[0].x][state[0].y] === board[state[1].x][state[1].y] &&
                board[state[1].x][state[1].y] === board[state[2].x][state[2].y] &&
                board[state[2].x][state[2].y] === board[state[0].x][state[0].y]
            ) {
                winner = board[state[0].x][state[0].y];
                return false;
            } 
        });

        if (winner !== null && winner.length) {
            throw {name: 'gameOver', message: '<p><span class="winner">' + winner + '</span> winner!</p>'};
        }
    },

    requestBotMove: function (game) {
        this.removeEvents();

        var board = this.boardState();

        $.ajax({
            url: 'http://localhost:5010/v1/' + game.botTeam + '/moves',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({board: board}),
        }).done(function (data) {
            try {
                game.move(
                    data.x,
                    data.y,
                    game.botTeam        
                );

                game.registerEvents(game);
            } catch (err) {
                if (err.name == 'gameOver') {
                    game.writeMessage(err.message);
                } 
            }
        }).fail(function (response) {
            if (response.status === 422) {
                game.writeMessage('Draw'); 
                return;
            }

            alert('Something goes wrong, sorry, try again later.');
        });
    },
    
    writeMessage: function (message) {
        $('.message').prepend(message);
    }
};

$(document).ready(function() {
    var game = new Game();
    game.registerEvents(game);
    game.registerRestartEvent(game);
});
