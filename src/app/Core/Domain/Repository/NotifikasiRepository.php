<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Notifikasi;
use App\Core\Domain\Model\NotifikasiId;

interface NotifikasiRepository {
    public function byId(NotifikasiId $notifikasiId) : ?Notifikasi;
    public function insert(Notifikasi $notifikasi): bool;
    public function update(Notifikasi $notifikasi): bool;
}