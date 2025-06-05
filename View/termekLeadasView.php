<?php
    include_once("../Model/adatbazisKezeles.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termék leadása</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <?php include_once("base/navbar.html"); ?>
    <div class="container my-2">
        <div class="row">
            <div class="col-12">
                <h1>Termék leadása</h1>
                <form action="../controller/controller.php" method="post">
                    <input type="hidden" name="leadas">
                
                    <div class="form-group my-2">
                        <label class="form-label" for="szeriaszam">Termék szériaszáma</label>
                        <input class="form-control" type="text" name="szeriaszam" id="szeriaszam" required maxlength="20" placeholder="Kötelezően kitöltendő, maximum 20 karakter">
                    </div>
                    <div class="form-group my-2">
                        <label class="form-label" for="gyarto">Termék gyártója</label>
                        <input class="form-control" type="text" name="gyarto" id="gyarto" required maxlength="20" placeholder="Kötelezően kitöltendő, maximum 20 karakter">
                    </div>
                    <div class="form-group my-2">
                        <label class="form-label" for="tipus">Termék típusa</label>
                        <input class="form-control" type="text" name="tipus" id="tipus" required maxlength="20" placeholder="Kötelezően kitöltendő, maximum 20 karakter">
                    </div>
                    
                    <div class="form-group my-2">
                        <label class="form-label" for="vnev">Kapcsolattartó vezetékneve</label>
                        <input class="form-control" type="text" name="vnev" id="vnev" required maxlength="30" placeholder="Kötelezően kitöltendő, maximum 30 karakter">
                    </div>

                    <div class="form-group my-2">
                        <label class="form-label" for="knev">Kapcsolattartó keresztneve</label>
                        <input class="form-control" type="text" name="knev" id="knev" required maxlength="30" placeholder="Kötelezően kitöltendő, maximum 30 karakter">
                    </div>

                    <div class="form-group my-2">
                        <label class="form-label" for="unev">Kapcsolattartó utóneve</label>
                        <input class="form-control" type="text" name="unev" id="unev" maxlength="30" placeholder="Maximum 30 karakter">
                    </div>

                    <div class="form-group my-2">
                        <label class="form-label" for="telefon">Kapcsolattartó telefonszáma</label>
                        <input class="form-control" type="text" name="telefon" id="telefon" maxlength="20" placeholder="Kötelezően kitöltendő, maximum 20 karakter">
                    </div>
                    
                    <div class="form-group my-2">
                        <label class="form-label" for="email">Kapcsolattartó e-mail címe</label>
                        <input class="form-control" type="email" name="email" id="email" maxlength="30" placeholder="Kötelezően kitöltendő, maximum 30 karakter">
                    </div>

                    <div class="form-group my-2">
                        <input type="submit" class="btn btn-primary" value="Felvitel">
                    </div>

                </form>
            </div>
        </div>
    </div>
   
    <?php include_once("base/footer.html"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>    
</body>
</html>

