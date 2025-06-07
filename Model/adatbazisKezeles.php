<?php

include_once("../Model/termek.php");
include_once("../Model/kapcsolattarto.php");
include_once("../Model/statusz.php");
include_once("../Model/szervizOsszesito.php");

abstract class AdatbazisKezeles {

    public static function termekIdKerese(string $szeriaszam): int {
        // Létezik-e már ez a termék az adatbázisban ugyanezel a szériaszámmal leadva?
        // - ha nem, 0-t adunk vissza
        // - ha igen, visszaadjuk az ID-t

        $id = 0;
        try {
            $con = new mysqli("localhost", "root", "", "Garamszegi_Tibor_KCS");
            $stmt = $con->prepare("SELECT `id` FROM `termek` WHERE `szeriaszam`=? AND `statuszid`=1;");
            
            $stmt->bind_param("s", $szeriaszam);  
            $stmt->execute();
            $stmt->bind_result($id2);

            while($stmt->fetch()){
                $id = $id2;
            }

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo("Hiba: " . $e->getMessage());
        }
        return $id; 
    }

    public static function termekFelvitel(Termek $termek): void {
        try {
            $con = new mysqli("localhost", "root", "", "Garamszegi_Tibor_KCS");
            $stmt = $con->prepare("INSERT INTO `termek` VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
            $id = "";
            $szeriaszam = $termek->getSzeriaszam();
            $gyarto = $termek->getGyarto();
            $tipus = $termek->getTipus();
            $leadas = $termek->getLeadas()->format('Y-m-d');
            $statuszId = $termek->getStatuszId();
            $statuszValtozas = $termek->getStatuszValtozas()->format('Y-m-d');
            $kapcsolattartoId = $termek->getKapcsolattartoId();
            
            $stmt->bind_param("sssssisi", $id, $szeriaszam, $gyarto, $tipus, $leadas, $statuszId, $statuszValtozas, $kapcsolattartoId);
            $stmt->execute();

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo("Hiba: " . $e->getMessage());
        }
    }

    public static function kapcsolattartoIdKerese(Kapcsolattarto $kapcsolattarto): int {
        // Létezik-e már ez a kapcsolattartó az adatbázisban?
        // - ha nem, 0-t adunk vissza
        // - ha igen, visszaadjuk az ID-t

        $id = 0;
        try {
            $con = new mysqli("localhost", "root", "", "Garamszegi_Tibor_KCS");
            $stmt = $con->prepare("SELECT `id` FROM `kapcsolattarto` WHERE `vnev`=? AND `knev`=? AND `unev`=? AND `telefon`=? AND `email`=? LIMIT 1;");
                        
            $vnev = $kapcsolattarto->getVnev();
            $knev = $kapcsolattarto->getKnev();
            $unev = $kapcsolattarto->getUnev();
            $telefon = $kapcsolattarto->getTelefon();
            $email = $kapcsolattarto->getEmail();
            
            $stmt->bind_param("sssss", $vnev, $knev, $unev, $telefon, $email);  
            $stmt->execute();
            $stmt->bind_result($id2);

            while($stmt->fetch()){
                $id = $id2;
            }

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo("Hiba: " . $e->getMessage());
        }
        return $id; 
    }

    public static function kapcsolattartoFelvitel(Kapcsolattarto $kapcsolattarto): int {
        $id = 0;
        try {
            $con = new mysqli("localhost", "root", "", "Garamszegi_Tibor_KCS");
            $stmt = $con->prepare("INSERT INTO `kapcsolattarto` VALUES (?, ?, ?, ?, ?, ?);");
            $id = "";
            $vnev = $kapcsolattarto->getVnev();
            $knev = $kapcsolattarto->getKnev();
            $unev = $kapcsolattarto->getUnev();
            $telefon = $kapcsolattarto->getTelefon();
            $email = $kapcsolattarto->getEmail();
            
            $stmt->bind_param("ssssss", $id,$vnev, $knev, $unev, $telefon, $email);
            $stmt->execute();
            $id = $stmt->insert_id;            

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo("Hiba: " . $e->getMessage());
        }
        return $id;              
    }

    public static function szervizOsszesitoLekerdezese(): array {
        $tomb = [];
        try {
            $con = new mysqli("localhost", "root", "", "Garamszegi_Tibor_KCS");
            /*
            $stmt = $con->prepare("SELECT * FROM `termek` LEFT JOIN `kapcsolattarto` ON `termek`.`kapcsolattartoid` = `kapcsolattarto`.`id` 
            LEFT JOIN `statusz` ON `statuszid` = `statusz`.`id` ORDER BY `statusz`.`id`;");
            */

            $stmt = $con->prepare("SELECT * FROM `termek` LEFT JOIN `kapcsolattarto` ON `termek`.`kapcsolattartoid` = `kapcsolattarto`.`id` 
            LEFT JOIN `statusz` ON `statuszid` = `statusz`.`id`
            WHERE NOT (`termek`.`statuszid` = 5 AND NOT (`termek`.`statuszvaltozas`=?))
            ORDER BY `statusz`.`id`;");

            $maiDatum = new DateTime(date("Y-m-d"));
            $maiDatum = $maiDatum->format('Y-m-d');
            $stmt->bind_param("s", $maiDatum);
            $stmt->execute();
            $stmt->bind_result($id, $szeriaszam, $gyarto, $tipus, $leadas, $statuszid, $statuszvaltizas, $kapcsolattartoid, $id1, 
            $vnev, $knev, $unev, $telefon, $email, $id2, $leiras);

            while($stmt->fetch()){
                $termek = new Termek(
                    $id,
                    $szeriaszam,
                    $gyarto,
                    $tipus,
                    new DateTime($leadas),
                    $statuszid,
                    new DateTime($statuszvaltizas),
                    $kapcsolattartoid
                );

                $kapcsolattarto = new Kapcsolattarto(
                    $id1,
                    $vnev,
                    $knev,
                    $unev,
                    $telefon,
                    $email
                );

                $statusz = new Statusz(
                    $id2,
                    $leiras
                );

                $szervizOsszesito = new SzervizOsszesito(
                    $termek,
                    $kapcsolattarto,
                    $statusz
                );

                $tomb[] = $szervizOsszesito;
            }

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo("Hiba: " . $e->getMessage());
        }       
        return $tomb;
    }

    public static function termekKiolvasasIdalapjan(int $id): Termek {
        try {
            $con = new mysqli("localhost", "root", "", "Garamszegi_Tibor_KCS");
            $stmt = $con->prepare("SELECT * FROM termek WHERE id = ?;");
            $stmt->bind_param("s", $id);    
            $stmt->execute();
            $stmt->bind_result($id, $szeriaszam, $gyarto, $tipus, $leadas, $statuszId, $statuszValtozas, $kapcsolattartoId);
            $stmt->fetch();

            $termek = new Termek(
                $id, 
                $szeriaszam,
                $gyarto,
                $tipus,
                new DateTime($leadas),
                $statuszId,
                new DateTime($statuszValtozas),
                $kapcsolattartoId
            );

            $stmt->close();
            $con->close();
            return $termek;
        } catch (Exception $e) {
            echo("Hiba: " . $e->getMessage());
            return new Termek(0, null, null, null, null, 0, null, 0);
        }
    }

     public static function statuszokListaja(): array {
        $statuszok = [];
        try {
            $con = new mysqli("localhost", "root", "", "Garamszegi_Tibor_KCS");
            $stmt = $con->prepare("SELECT * FROM `statusz`");
            $stmt->execute();
            $stmt->bind_result($id, $leiras);
            while($stmt->fetch()){
                $statusz = new Statusz(
                    $id,
                    $leiras
                );
                $statuszok[] = $statusz; 
            }

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo("Hiba: " . $e->getMessage());
        }
        return $statuszok;
    }

    public static function termekModositas(int $id, int $statusz): void {
        try {
            $con = new mysqli("localhost", "root", "", "Garamszegi_Tibor_KCS");
            $stmt = $con->prepare("UPDATE `termek` SET `statuszid` = ?, `statuszvaltozas` = ? WHERE `id` = ?;");
            $maiDatum = new DateTime(date("Y-m-d"));
            $maiDatum = $maiDatum->format('Y-m-d');
            $stmt->bind_param("dsd", $statusz, $maiDatum, $id);
            $stmt->execute();

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo("Hiba: " . $e->getMessage());
        }
    }

}