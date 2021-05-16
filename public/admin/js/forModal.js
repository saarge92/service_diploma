$('.delete').click(submitForm);
$('.deactivate-btn').click(submitForm);

function submitForm(event) {
    event.preventDefault();
    var form_delete = $(this).parent('form');
    console.log(form_delete);
    $('#exampleModal').modal({
        show: true,
    });
    $('#ok_btn').click(() => {
        form_delete.submit();
    });
}
