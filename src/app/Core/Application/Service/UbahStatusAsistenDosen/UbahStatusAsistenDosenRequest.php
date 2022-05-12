<?php

namespace App\Core\Application\Service\UbahStatusAsistenDosen;

class UbahStatusAsistenDosenRequest {
    public function __construct(
        public string $mahasiswa_id,
        public string $lowongan_id,
        public bool $diterima,
        public bool $dibayar
    ) { }
}