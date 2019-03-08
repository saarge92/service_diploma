/**
 * Обработка нажатия кнопки при назначении исполнителя
 */
$("#assignButton").on("click", function() {
    const userId = $("#executors").val();
    const orderId = $("#orderId").val();
    const token = $('meta[name="csrf-token"]').attr("content");
    const executorName = 1;
    $.ajax({
        type: "POST",
        url: `/admin/set-executor-order/${orderId}/${userId}`,
        data: {
            _token: token
        },
        success: function(result) {
            if (result == true) {
                try {
                    var newComponent = "<div>"+`<span class='float-left'>${executorName}</span>`;
                    $("#executors-block").prepend(
                        $(
                            "<li class='list-inline-item revokeExecutor'>" +
                                `<i class='fa fa-times'  data-order_id='${orderId}'>` +
                                "</i></li>"
                        )
                    );
                } catch (ex) {
                    console.log(ex);
                }
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});
<div>
<span class="float-left">{{$ex->name}}</span>
<span class="float-right revokeExecutor"  data-order_id="{{$ex->id}}"><i class="fa fa-times"></i></span>
{{-- <ul class="list-inline" id="list-executor" style="float:right;color:red">
<li class="list-inline-item revokeExecutor"><i class="fa fa-times"  data-order_id="{{$ex->id}}"></i></li>
</ul> --}}
</div>