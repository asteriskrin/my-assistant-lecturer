<?php

namespace App\Core\Application\Service\BuatNotifikasi;

class BuatNotifikasiRequest {
    public function __construct(
        public string $mahasiswaId,
        public string $jenis,
        public string $pesan,
    ) { }
}