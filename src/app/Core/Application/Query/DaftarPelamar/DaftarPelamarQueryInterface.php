<?php

namespace App\Core\Application\Query\DaftarPelamar;

interface DaftarPelamarQueryInterface {
    public function execute(string $lowongan_id) : array;
}
