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
			$("#feedback").html(data);
			if (!$("#taula").is(":hidden")) {
				$("#taula").hide();
			}
			showQuestions();
		},
		error: function () {
			alert("Errorea zerbitzarira konektatzerakoan");
		}
	});
}