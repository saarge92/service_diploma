/**
 * Отправка Ajax-запроса на сервер
 */
$("#addButton").on("click", function() {
    const textComment = $("#textComment").val();
    const token = $('meta[name="csrf-token"]').attr("content");
    const orderId = $("#orderId").val();
    const comment = $('#textComment').val()
    if (textComment) {
        $.ajax({
            type: "POST",
            url: "/executor/submitComment",
            data: {
                _token: token,
                orderId: orderId,
                textComment: comment
            },
            success: function(result){
                console.log(result);
            },
            error: function(error){
                console.log(error);
            }
        });
    }
});
