<?php

namespace App\Infrastructure\Repository;

use App\Core\Domain\Model\Dosen;
use App\Core\Domain\Repository\DosenRepository;
use Illuminate\Support\Facades\DB;

class SqlServerDosenRepository implements DosenRepository
{
  public function insert(Dosen $dosen): bool
  {
    $values = [
      'id' => $dosen->getId()->id(),
      'nama_lengkap' => $dosen->getNamaLengkap(),
      'nim' => null,
      'nip' => $dosen->getNip(),
      'url_transkrip_mk' => null,
      'ipk' => null,
      'semester' => null,
      'nomor_rekening' => null,
      'nomor_telepon' => $dosen->getNomorTelepon(),
      'email' => $dosen->getEmail(),
      'password' => $dosen->getPassword(),
      'created_at' => $dosen->getCreatedAt()->format('y-m-d'),
    ];

    return DB::table('user')->insert($values);
  }
}
