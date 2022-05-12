<?php

namespace App\Core\Application\Service\BuatLamaran;

class BuatLamaranRequest {
    public function __construct(
        public string $lowonganId,
        public string $mahasiswaId,
        public bool $diterima,
        public bool $dibayar
    ) { }
}