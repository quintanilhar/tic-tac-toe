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
                game.move(
                    $(this).data('row'),
                    $(this).data('column'),
                    game.humanTeam
                );

                $(this).unbind('click');

                game.requestBotMove(game);
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
    },

    requestBotMove: function (game) {
        this.removeEvents();

        board = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];

        $('.board-cell').each(function (index, item) {
            board[$(this).data('row')][$(this).data('column')] = $(this).find('input').val();
        });

        $.ajax({
            url: 'http://localhost:5010/v1/' + game.botTeam + '/moves',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({board: board}),
        }).done(function (data) {
            game.move(
                data.x,
                data.y,
                game.botTeam        
            );

            game.registerEvents(game);
        }).fail(function (response) {
            if (response.status === 422) {
                game.writeMessage('Game Over'); 
                return;
            }

            alert('Something goes wrong, sorry, try again later.');
        });
    },
    
    writeMessage: function (message) {
        $('.message').html(message);
    }
};

$(document).ready(function() {
    var game = new Game();
    game.registerEvents(game);
});
