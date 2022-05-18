<?php

namespace App\Core\Application\Service\UbahMahasiswa;

class UbahMahasiswaRequest
{
    public function __construct(
        public string $id,
        public string $namaLengkap,
        public string $nim,
        public string $urlTranskripMk,
        public float $ipk,
        public int $semester,
        public string $nomorRekening,
        public string $nomorTelepon,
        public string $email,
        public string $password
    ) {
    }
}
