<?php

namespace App\Core\Application\Query\DaftarRiwayatAsistensi;

interface DaftarRiwayatAsistensiQueryInterface {
    public function execute(string $mahasiswa_id) : array;
}
