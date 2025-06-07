<?php

class SzervizOsszesito {
    private Termek $termek;
    private Kapcsolattarto $kapcsolattarto;
    private Statusz $statusz;

    public function __construct(Termek $termek, Kapcsolattarto $kapcsolattarto, Statusz $statusz) {
        $this->termek = $termek;
        $this->kapcsolattarto = $kapcsolattarto;
        $this->statusz = $statusz;
    }

    public function getTermek(): Termek {
        return $this->termek;
    }

    public function getKapcsolattarto(): Kapcsolattarto {
        return $this->kapcsolattarto;
    }

    public function getStatusz(): Statusz {
        return $this->statusz;
    }

}