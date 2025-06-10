<?php
    include_once("../Model/adatbazisKezeles.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szerviz összesítő</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href=".\styles.css">
</head>
<body>
    <?php include_once("base/navbar.html"); ?>
    <div class="container my-2">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Szerviz összesítő</h1>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Szériaszám</th>
                                <th>Gyártó</th>
                                <th>Típus</th>
                                <th>Leadás dátuma</th>
                                <th>Státusz</th>
                                <th>Utolsó státuszváltozás dátuma</th>
                                <th>Kapcsolattartó</th>
                                <th>Telefonszám</th>
                                <th>E-mail cím</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php 
                            foreach ($tomb as $item) {
                                print("<tr ");
                                switch ($item->getTermek()->getStatuszId()) {
                                    case 1:
                                        $btnClass = "btn btn-primary";
                                        print(' class="table-primary">');
                                        break;
                                    case 2:
                                        $btnClass = "btn btn-danger";
                                        print(' class="table-danger">');
                                        break;
                                    case 3:
                                        $btnClass = "btn btn-warning";
                                        print(' class="table-warning">');
                                        break;
                                    case 4:
                                        $btnClass = "btn btn-info";
                                        print(' class="table-info">');
                                        break;
                                    case 5:
                                        $btnClass = "btn btn-success";
                                        print(' class="table-success">');
                                        break;
                                }
                                print("<td>" . $item->getTermek()->getSzeriaszam() . "</td>");
                                print("<td>" . $item->getTermek()->getGyarto() . "</td>");
                                print("<td>" . $item->getTermek()->getTipus() . "</td>");
                                print("<td>" . $item->getTermek()->getLeadas()->format('Y-m-d') . "</td>");
                                print("<td>" . '<a class="' . $btnClass . '" href="../controller/controller.php?folyamat=modositas&id=' . $item->getTermek()->getId() . '">' . $item->getStatusz()->getLeiras() . "</a></td>");
                                print("<td>" . $item->getTermek()->getStatuszValtozas()->format('Y-m-d') . "</td>");
                                print("<td>" . $item->getKapcsolattarto()->getNev() . "</td>");
                                print("<td>" . $item->getKapcsolattarto()->getTelefon() . "</td>");
                                print("<td>" . $item->getKapcsolattarto()->getEmail() . "</td>");
                             }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
    <?php include_once("base/footer.html"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>    
</body>
</html>

