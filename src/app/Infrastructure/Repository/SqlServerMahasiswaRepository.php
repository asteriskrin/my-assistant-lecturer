<?php

namespace App\Infrastructure\Repository;

use App\Core\Domain\Model\Mahasiswa;
use App\Core\Domain\Repository\MahasiswaRepository;
use Illuminate\Support\Facades\DB;

class SqlServerMahasiswaRepository implements MahasiswaRepository
{
  public function insert(Mahasiswa $mahasiswa): bool
  {
    $values = [
      'id' => $mahasiswa->getId()->id(),
      'nama_lengkap' => $mahasiswa->getNamaLengkap(),
      'nim' => $mahasiswa->getNim(),
      'nip' => null,
      'url_transkrip_mk' => $mahasiswa->getUrlTranskripMk(),
      'ipk' => $mahasiswa->getIpk(),
      'semester' => $mahasiswa->getSemester(),
      'nomor_rekening' => $mahasiswa->getNomorRekening(),
      'nomor_telepon' => $mahasiswa->getNomorTelepon(),
      'email' => $mahasiswa->getEmail(),
      'password' => $mahasiswa->getPassword(),
      'created_at' => $mahasiswa->getCreatedAt()->format('y-m-d'),
    ];

    return DB::table('user')->insert($values);
  }
}
