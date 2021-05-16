/**
 * Удаление пользователя в панеле администратора
 */
$(".deleteUser").on("click", function(event) {
    event.preventDefault();
    const userId = event.target.dataset["user_id"];
    const token = $("meta[name='csrf-token']").attr("content");
    var confirmation = confirm("Уверены, что хотите удалить пользователя ?");
    if (confirmation) {
        $.ajax({
            url: `/admin/deleteUserRequest/${userId}`,
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
