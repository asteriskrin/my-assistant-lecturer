<?php

namespace App\Core\Application\Query\DaftarRiwayatAsistensi;

class DaftarRiwayatAsistensiDto
{
    public function __construct(
        public string $id,
        public string $mata_kuliah_nama,
        public string $kode_kelas,
        public int $gaji,
        public string $tanggal_mulai,
        public string $tanggal_selesai
    ) {
    }
}
