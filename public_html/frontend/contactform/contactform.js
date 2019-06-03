$("#sendContact").on('click', function (event) {
    event.preventDefault();
    $(this).attr('disabled', 'true');
    let token = $("meta[name='csrf-token']").attr("content");
    let url = "/contactRequest";
    let name = $("#nameContact").val();
    let phone = $("#phoneContact").val();
    let comments = $("#commentsContact").val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: token,
            name: name,
            phone: phone,
            comments: comments
        },
        success: function (result) {
            $("#infoMessageModal").text("Ваша заявка принята");
            $("#contactInfoModal").modal({
                show: true
            });
            $("#nameContact").val("");
            $("#phoneContact").val("");
            $("#commentsContact").val("");
            console.log(result);
        },
        error: function (error) {
            console.log(error);
            alert("Произошла ошибка!Проверьте правильность ввода данных!");
        }
    });
    $(this).removeAttr("disabled");
});
