<?php

class Statusz {
    private int $id;
    private string $leiras;

    public function __construct(int $id, string $leiras) {
        $this->id = $id;
        $this->leiras = $leiras;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getLeiras(): string {
        return $this->leiras;
    }
}