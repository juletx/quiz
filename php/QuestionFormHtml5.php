<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="form">
            <form id="galderenF" name="galderenF" action="AddQuestion.php">
                <label for="eposta">Ehuko eposta(*):</label>
                <input type="email" id="eposta" name="eposta"
                    pattern="([a-z]{3,}[0-9]{3}@ikasle\.ehu\.eu?s)|([a-z]+\.?[a-z]{2,}@ehu.eu?s)" required>
                <br><br>
                <label for="galdera">Galdera(*):</label>
                <input type="text" id="galdera" name="galdera" minlength="10" required>
                <br><br>
                <label for="erantzun_zuzena">Erantzun zuzena(*):</label>
                <input type="text" id="erantzun_zuzena" name="erantzun_zuzena" required>
                <br><br>
                <label for="erantzun_okerra1">Erantzun okerra 1(*):</label>
                <input type="text" id="erantzun_okerra1" name="erantzun_okerra1" required>
                <br><br>
                <label for="erantzun_okerra2">Erantzun okerra 2(*):</label>
                <input type="text" id="erantzun_okerra2" name="erantzun_okerra2" required>
                <br><br>
                <label for="erantzun_okerra3">Erantzun okerra 3(*):</label>
                <input type="text" id="erantzun_okerra3" name="erantzun_okerra3" required>
                <br><br>
                <label>Zailtasuna(*):
                    <input type="radio" id="txikia" name="zailtasuna" value="1">
                    <label for="txikia">Txikia</label>
                    <input type="radio" id="ertaina" name="zailtasuna" value="2" checked>
                    <label for="ertaina">Ertaina</label>
                    <input type="radio" id="handia" name="zailtasuna" value="3">
                    <label for="handia">Handia</label></label>
                <br><br>
                <label for="gaia">Gaia(*):</label>
                <input type="text" id="gaia" name="gaia" required>
                <br><br>
                <input type="submit" value="Galdera gehitu">
                <input type="reset" value="Berrezarri">
            </form>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>