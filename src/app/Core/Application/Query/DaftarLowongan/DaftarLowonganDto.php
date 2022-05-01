<?php

namespace App\Core\Application\Query\DaftarLowongan;

class DaftarLowonganDto {
    public function __construct(
        public string $id,
        public string $dosen_id,
        public string $mata_kuliah_id,
        public string $kode_kelas,
        public int $gaji,
        public string $tanggal_mulai,
        public string $tanggal_selesai,
        public string $deskripsi,
        public bool $terbuka,
        public string $mata_kuliah_nama
    ) { }
}
