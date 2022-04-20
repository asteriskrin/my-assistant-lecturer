<?php

namespace App\Core\Application\Service\UbahLowongan;

class UbahLowonganRequest {
    public function __construct(
        public string $id,
        public string $dosenId,
        public string $mataKuliahId,
        public string $kodeKelas,
        public int $gaji,
        public string $tanggalMulai,
        public string $tanggalSelesai,
        public string $deskripsi
    ) { }
}