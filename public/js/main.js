
$(document).ready(function () {

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