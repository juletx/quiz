$(document).ready(function () {
	$.get("IncreaseGlobalCounter.php");

	showUserCount();
	setInterval(showUserCount, 5000);

	function showUserCount() {
		$.post('../xml/Counter.xml', function (d) {
			var counter = $(d).find("counter").text();
			$("#erabiltzaileKop").html("<h4>Erabiltzaile kopurua: " + counter + "</h4>");
		});
	}

	$(window).on("beforeunload", function () {
		$.get("DecreaseGlobalCounter.php");
	});
});