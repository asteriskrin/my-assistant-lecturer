<?php

namespace App\Infrastructure\Repository;

use App\Core\Domain\Model\Mahasiswa;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Repository\MahasiswaRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

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

  public function byId(MahasiswaId $mahasiswaId): ?Mahasiswa {
    $sql = "SELECT id, nama_lengkap, nim, url_transkrip_mk, ipk, semester, nomor_rekening, nomor_telepon, email, password, created_at FROM user WHERE id = :id";
    $result = DB::selectOne($sql, ['id' => $mahasiswaId->id()]);
    if ($result) {
      return new Mahasiswa(
        $mahasiswaId,
        $result->nama_lengkap,
        $result->nim,
        $result->url_transkrip_mk,
        $result->ipk,
        $result->semester,
        $result->nomor_rekening,
        $result->nomor_telepon,
        $result->email,
        $result->password,
        new DateTime($result->created_at)
      );
    }
    return NULL;
  }

  public function update(Mahasiswa $mahasiswa): bool
  {
    $values = [
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

    $affected = DB::table('user')->where('id', $mahasiswa->getId()->id())->update($values);

    return $affected === 1;
  }
}
