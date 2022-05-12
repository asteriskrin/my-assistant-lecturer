<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\MataKuliah;
use App\Core\Domain\Model\MataKuliahId;

interface MataKuliahRepository {
    public function byId(MataKuliahId $mataKuliahId): ?MataKuliah;
}
