/**
 * JS файл для удаления записи информации об обратном звонке
 */
$(".deleteUser").on("click", function(event) {
    event.preventDefault();
    const recordId = event.target.dataset["record_id"];
    const token = $("meta[name='csrf-token']").attr("content");
    var confirmation = confirm("Уверены, что хотите удалить пользователя ?");
    if (confirmation) {
        $.ajax({
            url: `/admin/delete-contact-info/${recordId}`,
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
