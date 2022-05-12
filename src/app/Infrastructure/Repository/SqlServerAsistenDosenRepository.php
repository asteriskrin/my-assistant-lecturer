<?php

namespace App\Infrastructure\Repository;

use App\Core\Domain\Model\AsistenDosen;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Repository\AsistenDosenRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class SqlServerAsistenDosenRepository implements AsistenDosenRepository
{
    public function byId(LowonganId $lowonganId, MahasiswaId $mahasiswaId) : ?AsistenDosen {
        $sql = "SELECT lowongan_id, mahasiswa_id, diterima, dibayar, created_at
                FROM asisten_dosen
                WHERE lowongan_id = :lowongan_id AND mahasiswa_id = :mahasiswa_id";

        $asistenDosen = DB::selectOne($sql, [
            'lowongan_id' => $lowonganId->id(),
            'mahasiswa_id' => $mahasiswaId->id()
        ]);

        if ($asistenDosen) {
            return new AsistenDosen(
                $mahasiswaId,
                $lowonganId,
                $asistenDosen->diterima == 'Y' ? true : false,
                $asistenDosen->dibayar == 'Y' ? true : false,
                new DateTime($asistenDosen->created_at)
            );
        }
        return null;
    }
    public function insert(AsistenDosen $asistenDosen): bool {
        $values = [
            'mahasiswa_id' => $asistenDosen->getMahasiswaId()->id(),
            'lowongan_id' => $asistenDosen->getLowonganId()->id(),
            'diterima' => $asistenDosen->getDiterima() ? 'Y' : 'N',
            'dibayar' => $asistenDosen->getDibayar() ? 'Y' : 'N',
            'created_at' => $asistenDosen->getCreatedAt()->format('y-m-d H:i:s') 
        ];
        return DB::table('asisten_dosen')->insert($values);
    }
    /**
     * Update data Asisten Dosen
     */
    public function update(AsistenDosen $asistenDosen): void {
        $data = [
            'mahasiswa_id' => $asistenDosen->getMahasiswaId()->id(),
            'lowongan_id' => $asistenDosen->getLowonganId()->id(),
            'diterima' => $asistenDosen->getDiterima() ? 'Y' : 'N',
            'dibayar' => $asistenDosen->getDibayar() ? 'Y' : 'N',
        ];
        $sql = "UPDATE asisten_dosen 
            SET diterima = :diterima, dibayar = :dibayar 
            WHERE mahasiswa_id = :mahasiswa_id AND lowongan_id = :lowongan_id";
        DB::update($sql, $data);
    }
}
