<?php include '../php/SecurityUsers.php' ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html'?>
    <script src="../js/ValidateFieldsQuestion.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
    <script src="../js/AddQuestionAjax.js"></script>
    <script src="../js/ShowQuestionsAjax.js"></script>
    <script src="../js/ShowQuestionCountAjax.js"></script>
    <script src="../js/ShowUserCountAjax.js"></script>
</head>

<body>
    <?php include '../php/Menus.php'?>
    <section class="main" id="s1">
        <h1>Galderak kudeatu</h1>
        <div id="erabiltzaileKop" class="rounded border-dark">
        </div>
        <div id="galderaKop" class="rounded border-dark">
        </div>
        <br>
        <div id="form">
            <form id="galderenF" name="galderenF">
                <fieldset>
                    <legend>
                        <h2>Galdera gehitu</h2>
                    </legend>
                    <div class="form-group">
                        <label for="eposta">Ehuko eposta(*):</label>
                        <input type="text" class="form-control" id="eposta" name="eposta"
                            value="<?php echo $_SESSION['eposta']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="galdera">Galdera(*):</label>
                        <input type="text" class="form-control" id="galdera" name="galdera">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="erantzuna">Erantzun zuzena(*):</label>
                            <input type="text" class="form-control" id="erantzuna" name="erantzuna">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="okerra1">Erantzun okerra 1(*):</label>
                            <input type="text" class="form-control" id="okerra1" name="okerra1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="okerra2">Erantzun okerra 2(*):</label>
                            <input type="text" class="form-control" id="okerra2" name="okerra2">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="okerra3">Erantzun okerra 3(*):</label>
                            <input type="text" class="form-control" id="okerra3" name="okerra3">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-7">
                            <label>Zailtasuna(*):</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="txikia" name="zailtasuna" value="1">
                                <label for="txikia" class="form-check-label">Txikia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="ertaina" name="zailtasuna" value="2"
                                    checked>
                                <label for="ertaina" class="form-check-label">Ertaina</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="handia" name="zailtasuna" value="3">
                                <label for="handia" class="form-check-label">Handia</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-5">
                            <label for="gaia">Gaia(*):</label>
                            <input type="text" class="form-control" id="gaia" name="gaia">
                        </div>
                    </div>
                    <label for="argazki">Argazkia:</label>
                    <img id="argazki" alt="Aukeratu argazkia" class="argazkia" src="#" />
                    <br><br>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="argazkiaa" name="argazkia" accept="image/*">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success" type="button" id="gehitu" value="Galdera gehitu">
                        <input class="btn btn-danger" type="reset" value="Berrezarri">
                    </div>
                </fieldset>
            </form>
        </div>
        <br>
        <div id="feedback" style="display:none" class="rounded border-dark">
        </div>
        <h2>Galderak ikusi XML</h2>
        <input class="btn btn-success" type="button" id="ikusi" value="Galderak ikusi/ezkutatu"
            onClick="showQuestions()">
        <br><br>
        <div class="table-responsive-sm" id="taula" style="display:none">
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>