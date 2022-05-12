<?php

namespace App\Infrastructure\Repository;

use App\Core\Domain\Model\Dosen;
use App\Core\Domain\Model\DosenId;
use App\Core\Domain\Repository\DosenRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class SqlServerDosenRepository implements DosenRepository
{
  public function byId(DosenId $dosenId) : ?Dosen {
    $sql = "SELECT id, nama_lengkap, nip, nomor_telepon, email, password, created_at
            FROM user
            WHERE id = :dosen_id";

    $dosen = DB::selectOne($sql, [
        'dosen_id' => $dosenId->id()
    ]);

    if ($dosen) {
        return new Dosen(
          $dosenId,
          $dosen->nama_lengkap,
          $dosen->nip,
          $dosen->nomor_telepon,
          $dosen->email,
          $dosen->password,
          new DateTime($dosen->created_at)
        );
    }
    return null;
  }
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
