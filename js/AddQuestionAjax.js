function addQuestion() {
	var form = $("#galderenF").get(0);
	$.ajax({
		url: '../php/AddQuestionWithImage.php',
		type: 'POST',
		data: new FormData(form),
		mimeType: 'multipart/form-data',
		contentType: false,
		processData: false,
		dataType: 'HTML',
		success: function (data) {
			var feedback = $(data).find("div");
			$("#feedback").html(feedback);
			if ($(feedback).find("p").length !== 0) {
				$("#feedback").show();
			}
			if (!$("#taula").is(":hidden")) {
				$("#taula").hide();
			}
			showQuestions();
		},
		error: function (data) {
			$("#feedback").html("Ezin izan da galdera sartu.");
			$("#feedback").show();
		}
	});
}