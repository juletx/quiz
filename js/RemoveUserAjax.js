$(document).ready(function () {
	$("button.ezabatu").click(function () {
		if (confirm('Ziur al zaude?')) {
			var td = $(this).parent();
			var eposta = td.siblings().first().text();

			$.ajax({
				url: "../php/RemoveUser.php?eposta=" + eposta,
				cache: false,
				success: function (result) {
					td.parent().remove();
				}
			});
		}
	});
});