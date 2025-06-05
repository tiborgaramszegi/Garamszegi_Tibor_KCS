<?php

include_once("../Model/adatbazisKezeles.php");
include_once("../Model/kapcsolattarto.php");
include_once("../Model/termek.php");

function termekLeadasView(): void {
    include_once("../View/termekLeadasView.php");
}

function main():void {
    if(array_key_exists("leadas", $_POST)) {
        // Termék leadása
        
        // Létezik-e már ez a termék az adatbázisban ugyanezel a szériaszámmal leadva?
        if (AdatbazisKezeles::termekIdKerese($_POST["szeriaszam"]) == 0) {
            // ha nem létezik a termék az adatbázisban ugyanezel a szériaszámmal leadva

            // Az utónév meg volt-e adva?
            $unev = "";
            if (array_key_exists("unev", $_POST)) {
                $unev = $_POST["unev"];
            }
            
            $kapcsolattarto = new Kapcsolattarto(
                0,
                $_POST["vnev"],
                $_POST["knev"],
                $unev,
                $_POST["telefon"],
                $_POST["email"]
            );

            // Létezik-e már ez a kapcsolattartó az adatbázisban?
            // - ha nem, 0-t kapunk vissza -> fel kell venni az új kapcsolattartót
            // - ha igen, visszakapjuk az ID-t
            
            $id = AdatbazisKezeles::kapcsolattartoIdKerese($kapcsolattarto);
            echo $id;
            if ($id == 0) {
                // új kapcsolattartó felvitele, és az ID kinyerése az adatbázisból
                  $id = AdatbazisKezeles::kapcsolattartoFelvitel($kapcsolattarto);
            }
            
            // új termék felvitele
            $termek = new Termek(
                0,
                $_POST["szeriaszam"],
                $_POST["gyarto"],
                $_POST["tipus"],
                new DateTime(date("Y-m-d")),
                1,
                new DateTime(date("Y-m-d")),
                $id            
            );
            AdatbazisKezeles::termekFelvitel($termek);
        }
        else {
            // ha már létezik a termék az adatbázisban ugyanezel a szériaszámmal leadva
            echo '<script type="text/javascript">alert("Ez a termék már leadott státuszban van!");</script>';
        }
        termekLeadasView();
    }
}

main();