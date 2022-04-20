<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Lowongan;
use App\Core\Domain\Model\LowonganId;

interface LowonganRepository {
    public function byId(LowonganId $lowongan) : ?Lowongan;
    public function save(Lowongan $lowongan): void;
    public function update(Lowongan $lowongan): void;
    public function delete(Lowongan $lowongan): void;
}