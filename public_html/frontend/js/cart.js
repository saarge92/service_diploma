$(".orderService").click(function(event) {
    const serviceId = event.target.dataset["service_id"];
    const token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        method: "POST",
        url: "/add-to-cart",
        type: "json",
        data: {
            serviceId: serviceId,
            _token: token
        },
        success: function(json) {
            // console.log(json);
            $("#count_order").text(json['count'])

        },
        error: function(message) {
            //console.log(message);
        }
    });
});
