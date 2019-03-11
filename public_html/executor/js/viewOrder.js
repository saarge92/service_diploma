/**
 * Отправка Ajax-запроса на сервер
 */
$("#addButton").on("click", function() {
    const textComment = $("#textComment").val();
    const token = $('meta[name="csrf-token"]').attr("content");
    const orderId = $("#orderId").val();
    const comment = $("#textComment").val();
    if (textComment) {
        $.ajax({
            type: "POST",
            url: "/executor/submitComment",
            data: {
                _token: token,
                orderId: orderId,
                textComment: comment
            },
            success: function(result) {
                if (result[0].created == true) {
                    const newComment = `<div class="comment">
                    <label>Автор : ${result[0].author}</label>
                    <div class="comment-text">
                    ${textComment}</div>
                    <div>
                        Дата ${result[0].create_date}
                    </div>
                    </div>`;
                    $("#comments").prepend($(newComment.toString()));
                    $('#textComment').val('');
                }
                console.log(result);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
});
