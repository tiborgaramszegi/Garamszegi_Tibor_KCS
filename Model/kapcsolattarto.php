<?php

class Kapcsolattarto {
    private int $id;
    private string $vnev;
    private string $knev;
    private string $unev;
    private string $telefon;
    private string $email;

    public function __construct(int $id, string $vnev, string $knev, string $unev, string $telefon, string $email) {
        $this->setId($id);
        $this->setVnev($vnev);
        $this->setKnev($knev);
        $this->setUnev($unev);
        $this->setTelefon($telefon);
        $this->setEmail($email);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getVnev(): string {
        return $this->vnev;
    }

    public function getKnev(): string {
        return $this->knev;
    }

    public function getUnev(): string {
        return $this->unev;
    }

    public function getTelefon(): string {
        return $this->telefon;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setId(int $id): void {
        if ($id >= 0) {
            $this->id = $id;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setVnev(string $vnev): void {
        if (strlen($vnev) <= 30) { 
            $this->vnev = $vnev;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setKnev(string $knev): void {
        if (strlen($knev) <= 30) { 
            $this->knev = $knev;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setUnev(string $unev): void {
        if (strlen($unev) <= 30) { 
            $this->unev = $unev;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setTelefon(string $telefon): void {
        if (strlen($telefon) <= 20) { 
            $this->telefon = $telefon;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function setEmail(string $email): void {
        if (strlen($email) <= 30 && str_contains($email, "@")
        && str_contains($email, ".")) { 
            $this->email = $email;
        }
        else {
            throw new InvalidArgumentException("A megadott érték nem megfelelő!");
        }
    }

    public function getNev(): string {
        return $this->vnev . " " . $this->knev . " " . $this->unev;
    }

}