<?php

namespace App\Infrastructure\Repository;

use App\Core\Domain\Model\MataKuliah;
use App\Core\Domain\Model\MataKuliahId;
use App\Core\Domain\Repository\MataKuliahRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class SqlServerMataKuliahRepository implements MataKuliahRepository
{
    public function byId(MataKuliahId $mataKuliahId) : ?MataKuliah {
        $sql = "SELECT id, nama, semester, kode
                FROM mata_kuliah
                WHERE id = :mata_kuliah_id";

        $mataKuliah = DB::selectOne($sql, [
            'mata_kuliah_id' => $mataKuliahId->id()
        ]);

        if ($mataKuliah) {
            return new MataKuliah(
                $mataKuliahId,
                $mataKuliah->nama,
                $mataKuliah->semester,
                $mataKuliah->kode
            );
        }
        return null;
    }
}
