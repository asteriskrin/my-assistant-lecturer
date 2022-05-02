<?php

namespace App\Core\Application\Query\DaftarLamaran;

use App\Core\Application\Query\DaftarLamaran\DaftarLamaranDto;

interface DaftarLamaranQueryInterface {
    public function execute(string $mahasiswa_id) : array;
}
