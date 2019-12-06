$(document).ready(function () {
	$("#jolastu").click(function () {
		$("#jolastu").prop('disabled', false);
		$.ajax({
			url: "GetQuestions.php",
			data: $('#gaia').serialize(),
			success: function (d) {
			}
		});
	});

	$("#erantzun").click(function () {
		$.ajax({
			url: "SaveResponse.php",
			data: $('#galdera').serialize(),
			success: function (d) {
			}
		});
	});

	$("#aldatu").click(function () {
	});

	$("#amaitu").click(function () {
		$.ajax({
			url: "ShowResult.php",
			data: $('#galdera').serialize(),
			success: function (d) {
			}
		});
	});
});