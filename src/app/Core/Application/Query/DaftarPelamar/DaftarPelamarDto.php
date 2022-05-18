<?php

namespace App\Core\Application\Query\DaftarPelamar;

class DaftarPelamarDto {
    public function __construct(
        public string $user_id,
        public string $nama_lengkap,
        public string $tanggal_melamar,
        public bool $diterima,
        public bool $dibayar
    ) { }
}
