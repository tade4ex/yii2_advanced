var AlphaCallback = function (data, id, cursor) {
    console.log('ee', data, id, cursor);
};

var realplexor = $.Realplexor({
    url: '//rpl.advanced.test'
})
.setCursor('Alpha', 0).subscribe('Alpha', AlphaCallback)
.execute();

$(document).ready(function(){
    $("#send-message").on("click", function(){
        $.ajax({
            url: "/hello/send/",
            method: "POST",
            dataType: "json",
            data: {
                message: 'test'
            },
            success: function(data){ console.log("Сообщение отправлено", data) },
            error: function(){ console.log("Ошибка") }
        });
    });
});