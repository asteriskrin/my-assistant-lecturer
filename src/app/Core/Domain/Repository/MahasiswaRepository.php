<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Mahasiswa;
use App\Core\Domain\Model\MahasiswaId;

interface MahasiswaRepository
{
  public function insert(Mahasiswa $mahasiswa): bool;
  public function byId(MahasiswaId $mahasiswaId): ?Mahasiswa;
}
