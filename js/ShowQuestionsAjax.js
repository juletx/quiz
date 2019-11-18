xhro = new XMLHttpRequest();
xhro.onreadystatechange = function () {
	if (xhro.readyState === 4 && xhro.status === 200) {
		document.getElementById('taula').innerHTML = xhro.responseText;
	}
}
function showQuestions() {
	var x = document.getElementById("taula");
	if (window.getComputedStyle(x).display === "none") {
		document.getElementById("taula").style.display = "inline-block";
		xhro.open("GET", "../php/ShowXmlQuestions.php");
		xhro.send();
	} else
		document.getElementById("taula").style.display = "none";
}