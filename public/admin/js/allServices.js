/**
 * Удаление пользователя в панеле администратора
 */
$(".service-delete").on("click", function(event) {
    event.preventDefault();
    const serviceId = event.target.dataset["service_id"];
    const token = $("meta[name='csrf-token']").attr("content");
    var confirmation = confirm("Уверены, что хотите удалить заявку ?");
    if (confirmation) {
        $.ajax({
            url: `/admin/service/delete/${serviceId}`,
            type: "POST",
            data: {
                _token: token
            },
            success: function(result) {
                if (result) {
                    window.location = result;
                    console.log(result);
                }
                //console.log(result);
            },
            error: function(error) {
                //console.log(error);
            }
        });
    }
});
