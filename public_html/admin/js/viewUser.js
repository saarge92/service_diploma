/**
 * Даровать роль пользователю
 */
$("#grantRole").on("click", function(event) {
    event.preventDefault();
    const token = $('meta[name="csrf-token"]').attr("content");
    const userId = $("#userId").val();
    const roleId = $("#roles").val();
    $.ajax({
        type: "POST",
        url: `/admin/grantRole/${userId}/${roleId}`,
        data: {
            _token: token
        },
        success: function(result) {
            console.log(result);
        },
        error: function(error) {
            console.log(error);
        }
    });
});

/**
 * Забрать роль у пользователя
 */
$("#rolesTable").on("click", ".revokeRole", function(event) {
    const token = $('meta[name="csrf-token"]').attr("content");
    const userId = $("#userId").val();
    const roleId = event.target.dataset["role_id"];
    $.ajax({
        type: "POST",
        url: `/admin/revokeRole/${userId}/${roleId}`,
        data: {
            _token: token
        },
        success: function(result) {
            console.log(result);
        },
        error: function(error) {
            console.log(error);
        }
    });
});
