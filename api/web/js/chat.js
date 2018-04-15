function Message (message, from, dateTime) {
    this.message = message;
    this.from = from;
    this.dateTime = dateTime;
}

Message.prototype.renderLeft = function () {
    return '<div class="direct-chat-msg">'
        + '<div class="direct-chat-info clearfix">'
        + '<span class="direct-chat-name pull-left">' + this.from + '</span>'
        + '<span class="direct-chat-timestamp pull-right">' + this.dateTime + '</span>'
        + '</div>'
        + '<div class="direct-chat-text">'
        + this.message
        + '</div>'
        + '</div>';
};

Message.prototype.renderRight = function () {
    return '<div class="direct-chat-msg right">'
        + '<div class="direct-chat-info clearfix">'
        + '<span class="direct-chat-name pull-right">' + this.from + '</span>'
        + '<span class="direct-chat-timestamp pull-left">' + this.dateTime + '</span>'
        + '</div>'
        + '<div class="direct-chat-text">'
        + this.message
        + '</div>'
        + '</div>';
};


$(document).ready(function () {
    $('#send-message').on('click', function () {
        var messageVal = $('[name=message]').val();

        // var userIdTo = 2;

        $.ajax({
            url: '/chat/send-message/',
            method: 'POST',
            dataType: 'json',
            data: {
                message: messageVal,
                user_from_id: userIdFrom,
                user_to_id: userIdTo
            },
            success: function () {
                var message = new Message(messageVal, 'Tadeusz Tunkiewicz', '0000-00-00 00:00');
                $('.direct-chat-messages').append(message.renderLeft());
                $('[name=message]').val('');
            },
            error: function () {
                console.log('error');
            }
        });
    });

    var timestamp = Math.round(new Date().getTime() / 1000);
    var chat = function (data, id, cursor) {
        console.log(data, id, cursor);
        cursor = parseInt(cursor.split('.')[0]);
        if (cursor > timestamp) {
            var message = new Message(data.message, data.fio, data.date_time);
            var messageId = data.message_id;
            $('.direct-chat-messages').append(message.renderRight());
            $.ajax({
                url: '/chat/seen-message/',
                method: 'POST',
                dataType: 'json',
                data: {
                    message_id: messageId
                },
                success: function () {
                    console.log('message seen');
                },
                error: function () {
                    console.log('error');
                }
            });
        }
        timestamp = Math.round(new Date().getTime() / 1000);

    };

    var realplexor = $.Realplexor({
        url: '//rpl.advanced.test'
    })
    .setCursor('user' + userIdFrom, 123)
    .subscribe('user' + userIdFrom, chat)
    .execute();

    // realplexor.unsubscribe('user' + userIdFrom).execute();
});

