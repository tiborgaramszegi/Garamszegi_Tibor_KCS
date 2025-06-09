<?php
    include_once("../Model/adatbazisKezeles.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termék státuszának módosítása</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="bg-white">
    <?php include_once("base/navbar.html"); ?>
    <div class="container my-2">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Termék státuszának módosítása</h1>
                <form action="../controller/controller.php" method="post">
                    <input type="hidden" name="modositas">
                    <input type="hidden" name="id" value="<?= $termek->getId() ?>">
                    <div class="form-group my-2">
                        <label class="form-label" for="szeriaszam">Szériaszám</label>
                        <input class="form-control" type="text" name="szeriaszam" id="szeriaszam" readonly value="<?= $termek->getSzeriaszam() ?>">
                    </div>
                    <div class="form-group my-2">
                        <label class="form-label" for="gyarto">Gyártó</label>
                        <input class="form-control" type="text" name="gyarto" id="gyarto" readonly value="<?= $termek->getGyarto() ?>">
                    </div>
                    <div class="form-group my-2">
                        <label class="form-label" for="tipus">Típus</label>
                        <input class="form-control" type="text" name="tipus" id="tipus" readonly value="<?= $termek->getTipus() ?>">
                    </div>
                    <div class="form-group my-2">
                        <label class="form-label" for="statusz">Státusz</label>
                        <select class="form-control" name="statusz" id="statusz" required>
                            <?php
                                foreach($statuszok as $item) {
                                    if($item->getId() == $termek->getStatuszId()) {
                                        echo '<option selected value="';
                                    }
                                    else {
                                        echo '<option value="';
                                    }
                                    echo $item->getId() . '">' . $item->getLeiras() .'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group my-2">
                        <input type="submit" class="btn btn-danger" value="Módosítás">
                    </div>
                </form>
                
                <form action="../controller/controller.php" method="post">
                    <input type="hidden" name="megsem">
                    <input type="submit" class="btn btn-success" value="Mégsem">
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

