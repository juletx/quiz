$(document).ready(function () {
	$('#pasahitza').on('change input', function () {
		var pasahitza = $("#pasahitza").val();
		$.get('../php/ClientVerifyPass.php', { 'pasahitza': pasahitza }, function (d) {
			if (d === "Pasahitz balioduna") {
				$("#baliozkoa").css('color', 'green');
					$("#submit").prop('disabled', false);
			} else {
				$("#baliozkoa").css('color', 'red');
                $("#submit").prop('disabled', true);
            }
			$("#baliozkoa").html(d);
		});
	});

	$("input[type='reset']").click(function() {
		$('#baliozkoa').text("");
		$('#matrikulatuta').text("");
	});
});
