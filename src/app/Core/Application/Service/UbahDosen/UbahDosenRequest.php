<?php

namespace App\Core\Application\Service\UbahDosen;

class UbahDosenRequest
{
    public function __construct(
        public string $id,
        public string $namaLengkap,
        public string $nip,
        public string $nomorTelepon,
        public string $email,
        public string $password
    ) {
    }
}
