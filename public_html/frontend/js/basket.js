/**
 * Обработчик нажатия кнопки "уменьшить на один элемент, который там есть"
 */
$(".reduceOne").click(function(event) {
    const orderId = event.target.dataset["order_id"];
    const token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        method: "POST",
        url: "/reduceByOne",
        type: "json",
        data: {
            orderId: orderId,
            _token: token
        },
        /**
         * при успешном выполнении"
         */
        success: function(json) {
            var count_of_element = json["updated_results"]["count_of_element"];
            var totalPrice = json["updated_results"]["totalPrice"];
            var totalQty = json["updated_results"]["totalQty"];
            var currentPrice = json["updated_results"]["price"];
            if (count_of_element <= 0) {
                event.target.closest(".list-group-item").remove();
            } else {
                event.target
                    .closest(".list-group-item")
                    .querySelector(".order_qty").textContent = count_of_element;
                event.target
                    .closest(".list-group-item")
                    .querySelector(".current_price").textContent = currentPrice;
            }
            if (totalQty <= 0) {
                $("#totalPrice").text("Выбранные заявки отсутствуют");
                $("#commit_order").remove();
                $("#count_order").text("");
                $("#totalPrice")
                    .closest(".col")
                    .append(
                        $(
                            '<a class="btn btn-success" href=' +
                                "/#services" +
                                ">Перейти к услугам</a>"
                        )
                    );
            } else {
                $("#totalPrice").text("Всего : " + totalPrice);
                $("#count_order").text(totalQty);
            }
        },
        error: function(message) {
            console.log(message);
        }
    });
});

/**
 * Увеличение на 1 позицию
 */
$(".increaseItem").click(function(event) {
    const orderId = event.target.dataset["order_id"];
    const token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        method: "POST",
        url: "/increaseByOne",
        data: {
            orderId: orderId,
            _token: token
        },
        success: function(json) {
            var totalQty = json["updated_results"]["totalQty"];
            var count_of_element = json["updated_results"]["count_of_element"];
            var currentPrice = json["updated_results"]["price"];
            var totalPrice = json["updated_results"]["totalPrice"];
            $("#count_order").text(totalQty);
            event.target
                .closest(".list-group-item")
                .querySelector(".order_qty").textContent = count_of_element;
            event.target
                .closest(".list-group-item")
                .querySelector(".current_price").textContent = currentPrice;
            $("#totalPrice").text("Всего : " + totalPrice);
        },
        error: function(error) {
            console.log(error);
        }
    });
});

/**
 * Удаление польностью
 */
$(".deleteAll").on("click", function(event) {
    var _id = event.target.dataset["order_id"];
    console.log(_id);
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        method: "POST",
        url: "/deleteItemRequest",
        data: {
            orderId: _id,
            _token: token
        },
        success: function(json) {
            event.target.closest(".list-group-item").remove();
            var totalQty = json["updated_results"]["totalQty"];
            var totalPrice = json["updated_results"]["totalPrice"];
            if (totalQty <= 0) {
                $("#count_order").text("");
                $("#totalPrice").text("Выбранные заявки отсутствуют");
                $("#commit_order").remove();
                $("#totalPrice")
                    .closest(".col")
                    .append(
                        '<a class="btn btn-success" href=' +
                            '"/#services' +
                            ">Перейти к услугам</a>"
                    );
            } else {
                $("#totalPrice").text("Всего : " + totalPrice);
                $("#count_order").text(totalQty);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});
