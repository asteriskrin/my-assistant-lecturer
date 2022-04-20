<?php

namespace App\Core\Application\Service\BuatLowongan;

class BuatLowonganRequest {
    public function __construct(
        public string $dosenId,
        public string $mataKuliahId,
        public string $kodeKelas,
        public int $gaji,
        public string $tanggalMulai,
        public string $tanggalSelesai,
        public string $deskripsi
    ) { }
}