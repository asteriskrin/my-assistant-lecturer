<?php

namespace App\Core\Application\Service\BuatDosen;

class BuatDosenRequest
{
    public function __construct(
        public string $namaLengkap,
        public string $nip,
        public string $nomorTelepon,
        public string $email,
        public string $password
    ) {
    }
}
