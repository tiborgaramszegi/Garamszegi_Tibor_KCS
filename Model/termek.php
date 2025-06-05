<?php

class Termek {
    private int $id;
    private string $szeriaszam;
    private string $gyarto;
    private string $tipus;
    private DateTime $leadas;
    private int $statuszId;
    private DateTime $statuszValtozas;
    private int $kapcsolattartoId;

    public function __construct(int $id, string $szeriaszam, string $gyarto, string $tipus,
    DateTime $leadas, int $statuszId, DateTime $statuszValtozas, int $kapcsolattartoId) {
        $this->setId($id);
        $this->setSzeriaszam($szeriaszam);
        $this->setGyarto($gyarto);
        $this->setTipus($tipus);
        $this->setLeadas($leadas);
        $this->setStatuszId($statuszId);
        $this->setStatuszValtozas($statuszValtozas);
        $this->setKapcsolattartoId($kapcsolattartoId);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getSzeriaszam(): string {
        return $this->szeriaszam;
    }

    public function getGyarto(): string {
        return $this->gyarto;
    }

    public function getTipus(): string {
        return $this->tipus;
    }

    public function getLeadas(): DateTime {
        return $this->leadas;
    }

    public function getStatuszId(): int {
        return $this->statuszId;
    }

    public function getStatuszValtozas(): DateTime {
        return $this->statuszValtozas;
    }

    public function getKapcsolattartoId(): int {
        return $this->kapcsolattartoId;
    }

    public function setId(int $id): void {
        if ($id >= 0) {
            $this->id = $id;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setSzeriaszam(string $szeriaszam): void {
        if (strlen($szeriaszam) <= 20) { 
            $this->szeriaszam = $szeriaszam;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setGyarto(string $gyarto): void {
        if (strlen($gyarto) <= 20) { 
            $this->gyarto = $gyarto;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setTipus(string $tipus): void {
        if (strlen($tipus) <= 20) { 
            $this->tipus = $tipus;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setLeadas(DateTime $leadas): void {
        $this->leadas = $leadas;
    }

    public function setStatuszId(int $statuszId): void {
        if ($statuszId >= 1) {
            $this->statuszId = $statuszId;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setStatuszValtozas(DateTime $statuszValtozas): void {
        $this->statuszValtozas = $statuszValtozas;
    }

    public function setKapcsolattartoId(int $kapcsolattartoId): void {
        if ($kapcsolattartoId >= 0) {
            $this->kapcsolattartoId = $kapcsolattartoId;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }
}