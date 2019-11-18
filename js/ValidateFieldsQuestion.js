$(document).ready(function() {
    $("#gehitu").click(function() {
        if (checkRequired() && checkEposta() && checkGaldera() && checkZailtasuna()) {
            addQuestion();
        }

        function checkRequired() {
            var empty = true;
            $('input[type="text"]').each(function () {
                if ($(this).val().trim() == "") {
                    alert("Bete eremu guztiak");
                    empty = false;
                    return empty;
                }
            })
            return empty;
        }

        function checkEposta() {
            var eposta = $("#eposta").val().trim();
            var epostaikasle = /[a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s/;
            var epostairakasle = /[a-z]+\.?[a-z]{2,}@ehu\.eu?s/;
            if ((eposta.match(epostaikasle) == eposta) || (eposta.match(epostairakasle) == eposta))
                return true;
            alert("Posta elektronikoa ez da zuzena");
            return false;
        }

        function checkGaldera() {
            var galdera = $('#galdera').val().trim();
            if (galdera.length < 10) {
                alert("Galderak gutxienez 10 karaktere izan behar ditu");
                return false;
            }
            return true;
		}
		
		function checkZailtasuna() {
			var zailtasuna = $("input[name='zailtasuna']:checked").val();
			if (zailtasuna !== "1" && zailtasuna !== "2" && zailtasuna !== "3") {
				alert("Zailtasunak txikia, ertaina edo handia izan behar du");
				return false;
			}
			return true;
		}
    });
});
