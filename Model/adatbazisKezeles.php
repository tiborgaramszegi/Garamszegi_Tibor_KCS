<?php
abstract class AdatbazisKezeles {

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

}