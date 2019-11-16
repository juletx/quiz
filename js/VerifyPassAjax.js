$(document).ready(function () {
	$("#pasahitza").focusout(function () {
		var pasahitza = $("#pasahitza").val();
		$.get('../php/ClientVerifyPass.php', { 'pasahitza': pasahitza }, function (d) {
			if (d === "Pasahitz balioduna") {
				$("#baliozkoa").css('color', 'green');
			} else {
				$("#baliozkoa").css('color', 'red');
				$("#submit").attr("disabled", "disabled");
			}
			$("#baliozkoa").html(d);
		});
	});
});
