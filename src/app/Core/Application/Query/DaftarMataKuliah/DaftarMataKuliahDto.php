<?php

namespace App\Core\Application\Query\DaftarMataKuliah;

class DaftarMataKuliahDto {
    public function __construct(
        public string $id,
        public string $nama,
        public int $semester,
        public string $kode
    ) { }
}
