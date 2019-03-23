/**
 * Удаление пользователя в панеле администратора
 */
$(".deleteRequest").on("click", function(event) {
    event.preventDefault();
    const requestId = event.target.dataset["request_id"];
    const token = $("meta[name='csrf-token']").attr("content");
    var confirmation = confirm("Уверены, что хотите удалить заявку ?");
    if (confirmation) {
        $.ajax({
            url: `/admin/deleteRequest/${requestId}`,
            type: "POST",
            data: {
                _token: token
            },
            success: function(result) {
                if (result == true) {
                    event.target.closest("tr").remove();
                }
                console.log(result);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
});
