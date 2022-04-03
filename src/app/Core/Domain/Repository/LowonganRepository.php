<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Lowongan;

interface LowonganRepository {
    public function save(Lowongan $lowongan): void;
    // TODO: Add method for select, update, and delete
}