<?php

namespace App\Core\Application\Query\DaftarNotifikasi;

use App\Core\Application\Query\DaftarNotifikasi\DaftarNotifikasiDto;

interface DaftarNotifikasiQueryInterface {
    public function execute(string $mahasiswa_id) : array;
    public function byId(string $notifikasi_id) : ?DaftarNotifikasiDto;
}
