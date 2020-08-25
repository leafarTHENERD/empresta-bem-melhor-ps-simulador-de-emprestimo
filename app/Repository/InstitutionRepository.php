<?php

namespace App\Repository;

class InstitutionRepository {
    private $institutions = [];

    public function __construct() {
        $this->institutions = [
            [
                "chave" => "PAN",
                "valor" => "Pan"
            ],
            [
                "chave" => "OLE",
                "valor" => "Ole"
            ],
            [
                "chave" => "BMG",
                "valor" => "Bmg"
            ]
        ];
    }

    public function all() {
        return $this->institutions;
    }
}