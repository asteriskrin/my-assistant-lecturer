<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Dosen;
use App\Core\Domain\Model\DosenId;

interface DosenRepository
{
  public function insert(Dosen $dosen): bool;
  public function byId(DosenId $dosenId): ?Dosen;
  public function update(Dosen $dosen): bool;
}
