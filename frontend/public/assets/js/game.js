var Game = function () {
};

Game.prototype = {
    constructor: Game,
    humanTeam: 'X',
    botTeam: 'O',
    turns: [],

    registerEvents: function (game) {
        $('.board-cell')
            .filter(function() {
                return !$(this).find('input').val();
            })
            .on('click', function(e) {
                    game.move(
                        $(this).data('row'),
                        $(this).data('column'),
                        game.humanTeam
                    ).done(function (data) {
                        if (data && data.status === 'gameover') {
                            this.writeMessage('<p>' + data.message + '</p>');
                            this.removeEvents();
                            return;
                        }

                        this.requestBotMove(this);
                 });

                 $(this).unbind('click');
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

            game.turns = [];
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

        this.turns.push({
            'team'   : team,
            'row'    : xCoordinate,
            'column' : yCoordinate
        });

        return this.validateGameOver();
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
        return $.ajax({
            url: 'http://localhost:5010/v1/games',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({turns: this.turns}),
            context: this,
        }).fail(function (response) {
            alert('Something goes wrong, sorry, try again later.');
        });
    },

    requestBotMove: function (game) {
        this.removeEvents();

        var board = this.boardState();

        $.ajax({
            url: 'http://localhost:5010/v1/bots/' + game.botTeam + '/moves',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({board: board}),
        }).done(function (data) {
            game.move(
                data.x,
                data.y,
                game.botTeam        
            ).done(function(data) {
                if (data && data.status === 'gameover') {
                    this.writeMessage('<p>' + data.message + '</p>');
                    return;
                }

                this.registerEvents(this);
            });
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
