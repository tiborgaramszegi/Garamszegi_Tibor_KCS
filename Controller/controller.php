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
        
        // Az utónév meg volt-e adva?
        $unev = "";
        if (array_key_exists("unev", $_POST)) {
            $unev = $_POST["unev"];
        }
        
        // új kapcsolattartó felvitele, ID kinyerése
        $kapcsolattarto = new Kapcsolattarto(
            0,
            $_POST["vnev"],
            $_POST["knev"],
            $unev,
            $_POST["telefon"],
            $_POST["email"]
        );
        $id = AdatbazisKezeles::kapcsolattartoFelvitel($kapcsolattarto);

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
        termekLeadasView();
    }
}

main();