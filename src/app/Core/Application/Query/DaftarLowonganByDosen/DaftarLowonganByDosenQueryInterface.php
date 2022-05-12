<?php

namespace App\Core\Application\Query\DaftarLowonganByDosen;

use App\Core\Application\Query\DaftarLowonganByDosen\DaftarLowonganByDosenDto;

interface DaftarLowonganByDosenQueryInterface {
    public function execute(string $dosen_id) : array;
}
