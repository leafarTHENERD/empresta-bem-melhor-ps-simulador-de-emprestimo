<?php

namespace App\Repository;

class InsuranceRepository {
    private $insuranceCompanies = [];

    public function __construct() {
        $this->insuranceCompanies = [
            [
                "chave" => "INSS",
                "valor" => "INSS"
            ],
            [
                "chave" => "FEDERAL",
                "valor" => "Federal"
            ],
            [
                "chave" => "SIAPE",
                "valor" => "Siape"
            ]
        ];
    }

    public function all() {
        return $this->insuranceCompanies;
    }
}