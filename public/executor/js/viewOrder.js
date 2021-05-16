/**
 * Отправка Ajax-запроса с комментарием на сервер
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
                    //Если коммент оставил админ
                    var newComment = null;

                    if (result[0].isAdmin) {
                        newComment = `<div class="comment">
                        <label>Автор : ${result[0].author}</label>
                        <div class="comment-text">
                        ${textComment}</div>
                        <div>
                            Дата ${result[0].create_date}
                        </div>
                        <button class="deleteButton" data-comment_id="${
                            result[0].id
                        }"> <i class="fas fa-times"></i> Удалить</button>
                        </div>`;
                    } else {
                        newComment = `<div class="comment">
                        <label>Автор : ${result[0].author}</label>
                        <div class="comment-text">
                        ${textComment}</div>
                        <div>
                            Дата ${result[0].create_date}
                        </div>
                        </div>`;
                    }
                    $("#comments").prepend($(newComment.toString()));
                    $("#textComment").val("");
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
});

/**
 * Отправка Ajax запроса с установка статуса заявки
 */
$("#setUpStatus").on("click", function(event) {
    event.preventDefault();
    const orderId = $("#orderId").val();
    const statusId = $("#statusSelect").val();
    const token = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "POST",
        url: `/executor/setStatusOrder`,
        data: {
            _token: token,
            orderId: orderId,
            statusId: statusId
        },
        success: function(result) {
            showMessage(result);
        },
        error: function(error) {
            showMessage(false);
        }
    });
});

function showMessage(result) {
    var headerText = null;
    var messageBody = null;
    if (result) {
        headerText = "Успех!";
        messageBody = "Статус успешно обновлен!";
    } else {
        headerText = "Ошибка";
    }
    $("#headerModal").text(headerText);
    $("#modalBody").text(messageBody);
    $("#statusModal").modal({
        show: true
    });
}
