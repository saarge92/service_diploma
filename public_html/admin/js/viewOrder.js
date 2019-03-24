/**
 * Обработка нажатия кнопки при назначении исполнителя
 */
$("#assignButton").on("click", function() {
    const userId = $("#executors").val();
    const orderId = $("#orderId").val();
    const token = $('meta[name="csrf-token"]').attr("content");
    const executorName = $("#executors option:selected").text();
    $(".ajax-loader").css("display", "block");

    $.ajax({
        type: "POST",
        url: `/admin/set-executor-order/${orderId}/${userId}`,
        data: {
            _token: token
        },
        success: function(result) {
            if (result == true) {
                try {
                    var newComponent =
                        "<div>" +
                        `<span class='nameExecutor'>${executorName}</span>` +
                        `<span class='float-right revokeExecutor'><i class='fa fa-times' data-user_id=${userId}></i></span>`;
                    $("#executors-block").prepend($(newComponent.toString()));
                    $(`#executors option[value='${userId}']`).remove();
                } catch (ex) {
                    console.log(ex);
                }
            }
            $(".ajax-loader").css("display", "none");
        },
        error: function(error) {
            console.log(error);
            $(".ajax-loader").css("display", "none");
        }
    });
});

/**
 * Обработка нажатия на кнопку - Удалить клиента из заказа
 */
$("#executors-block").on("click", ".revokeExecutor", function(event) {
    const userId = event.target.dataset["user_id"];
    const orderId = $("#orderId").val();
    const token = $('meta[name="csrf-token"]').attr("content");
    $(".ajax-loader").css("display", "block");
    $.ajax({
        type: "POST",
        url: `/admin/revoke-executor-order/${orderId}/${userId}`,
        data: {
            _token: token
        },
        success: function(result) {
            if (result == true) {
                var nameExecutor = event.target
                    .closest("div")
                    .querySelector(".nameExecutor").textContent;
                console.log(nameExecutor);
                var newExecutorElement = `<option value=${userId}>${nameExecutor}</option>`;
                event.target.closest("div").remove();
                $("#executors").append($(newExecutorElement.toString()));
                $("#executors");
            }
            $(".ajax-loader").css("display", "none");
            console.log(result);
        },
        error: function(error) {
            $(".ajax-loader").css("display", "none");
            console.log(error);
        }
    });
});

/**
 * Удаление комментария администратором
 */
$("#comments").on("click", ".deleteButton", function(event) {
    event.preventDefault();
    const commentId = event.target.dataset["comment_id"];
    const token = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "POST",
        url: `/admin/deleteCommentRequest/${commentId}`,
        data: {
            _token: token
        },
        success: function(result) {
            if (result == true) {
                event.target.closest(".comment").remove();
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});
