<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\AsistenDosen;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\MahasiswaId;

interface AsistenDosenRepository {
    public function byId(LowonganId $lowonganId, MahasiswaId $mahasiswaId): ?AsistenDosen;
    public function insert(AsistenDosen $asistenDosen): bool;
}
