<?php

namespace App\Core\Application\Query\DaftarLowongan;

class DaftarLowonganDto {
    public function __construct(
        public string $kode_kelas,
        public int $gaji,
        public string $tanggal_mulai,
        public string $tanggal_selesai,
        public string $deskripsi,
        public bool $terbuka
    ) { }
}
