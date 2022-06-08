<?php

namespace App\Core\Application\Query\DaftarLowongan;

class DaftarLowonganDto {
    public function __construct(
        public string $id,
        public string $mahasiswa_id,
        public string $jenis,
        public string $pesan,
        public bool $dibaca,
    ) { }
}
