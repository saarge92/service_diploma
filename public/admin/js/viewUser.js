/**
 * Даровать роль пользователю
 */
$("#grantRole").on("click", function (event) {
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
        success: function (result) {
            console.log(result);
            switch (result) {
                case 'created': {
                    const roleName = $('#roles option:selected').text();
                    const newRow = `<tr>
                    <td>
                        <span class="float-left nameExecutor">${roleName}</span>
                    </td>
                    <td>
                        <button class="btn btn-danger float-right revokeRole"  data-role_id="${roleId}">
                            <i class="fa fa-times"></i>
                            Удалить
                        </button>
                    </td>
                    </tr>`;
                    $('#rolesTable').append($(newRow.toString()));
                    break;
                }
                case 'existed' :{
                    var headerText = 'Предупреждение';
                    var messageBody = 'Пользователь уже состоит в этой роли';
                    showMessage(headerText,messageBody);
                    break;
                }
                case 'error':{
                    var headerText = 'Ошибка';
                    var messageBody = 'Произошла ошибка! Обратитесь к администратору!';
                    showMessage(headerText,messageBody);                   
                    break;
                }
            }

        },
        error: function (error) {
            var headerText = 'Ошибка';
            var messageBody = 'Произошла ошибка!Обратитесь к администратору';
            showMessage(headerText,messageBody);                   
            break;
        }
    });
});

function showMessage(headerText,messageBody){
    $("#headerModal").text(headerText);
    $("#modalBody").text(messageBody);
    $("#statusModal").modal({
        show: true
    });
};

/**
 * Забрать роль у пользователя
 */
$("#rolesTable").on("click", ".revokeRole", function (event) {
    const token = $('meta[name="csrf-token"]').attr("content");
    const userId = $("#userId").val();
    const roleId = event.target.dataset["role_id"];
    $.ajax({
        type: "POST",
        url: `/admin/revokeRole/${userId}/${roleId}`,
        data: {
            _token: token
        },
        success: function (result) {
            if(result == true){
                event.target.closest('tr').remove();
            }
            else if (result == false)
            {
                var headerText = 'Ошибка';
                var messageBody = 'Произошла ошибка!Обратитесь к администратору';
                showMessage(headerText,messageBody);         
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
});
