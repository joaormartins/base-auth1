$(function () {

	$("form.ajax").submit(function (e) {
		e.preventDefault();


		var form = $(this);

		$.ajax({
			url: form.attr("action"),
			data: form.serialize(),
			method: "post",
			dataType: "json",
			beforeSend: function () {
				ajax_load("open");
			},
			success: function (data) {
				ajax_load("close");
				
				if (data.message) {
					let r_type = data.message.type;
					if (r_type == "error")
						r_type = "danger";

					let view = "<div class='alert alert-" + r_type + "'>" + data.message.message + "</div>";
					$("#flash_main").html(view);
				}

				if (data.redirect) {
					window.location.href = data.redirect.url;
				}
			}
		});

		return false;
	});

	// loader
	function ajax_load(action) {
		ajax_load_div = $(".ajax_load");

		if (action === 'open') {
			ajax_load_div.fadeIn(200).css("display", "flex");
		}else if (action === "close") {
			ajax_load_div.fadeOut(200);
		}
	}

});