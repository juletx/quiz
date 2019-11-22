$(document).ready(function () {
	$("button.aldatu").click(function () {
		var td = $(this).parent();
		var eposta = td.siblings().first().text();

		$.ajax({
			url: "../php/ChangeState.php?eposta=" + eposta,
			cache: false,
			success: function (result) {
				td.prev().text(result);
			},
		});
	});
});