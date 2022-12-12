<?php

namespace App\Infrastructure\Repository;

use App\Core\Domain\Repository\LowonganRepository;
use App\Core\Domain\Model\Lowongan;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\DosenId;
use App\Core\Domain\Model\MataKuliahId;
use DB;
use DateTime;
use Illuminate\Support\Facades\Redis;

class SqlServerLowonganRepository implements LowonganRepository {
    /**
     * Select by Id
     */
    public function byId(LowonganId $lowonganId) : ?Lowongan {
        // Get data from redis
        $redis_key = 'lowongan'.$lowonganId->id();
        if (Redis::exists($redis_key)) {
            $lowongan_unserialized = unserialize(Redis::get($redis_key));
            return Lowongan::unserialize($lowongan_unserialized);
        }

        $sql = "SELECT id, dosen_id, mata_kuliah_id, kode_kelas, gaji, tanggal_mulai, tanggal_selesai, deskripsi, terbuka, created_at
                FROM lowongan
                WHERE id = :id";

        $lowongan = DB::selectOne($sql, [
            'id' => $lowonganId->id()
        ]);

        if ($lowongan) {
            // Write data to redis
            Redis::set($redis_key, serialize($lowongan));
            Redis::expire($redis_key, 3600*3);

            return new Lowongan(
                $lowonganId,
                new DosenId($lowongan->dosen_id),
                new MataKuliahId($lowongan->mata_kuliah_id),
                $lowongan->kode_kelas,
                $lowongan->gaji,
                new DateTime($lowongan->tanggal_mulai),
                new DateTime($lowongan->tanggal_selesai),
                $lowongan->deskripsi,
                $lowongan->terbuka == 'Y' ? true : false,
                new DateTime($lowongan->created_at)
            );
        }


        return null;
    }
    /**
     * Save Lowongan data into database.
     */
    public function save(Lowongan $lowongan) : void {
        $sql = "SELECT id FROM lowongan WHERE id = :id";

        $exists = DB::selectOne($sql, [
            'id' => $lowongan->getId()->id()
        ]);
        
        if ($exists) {
            $this->update($lowongan);
        }
        else {
            $data = [
                'id' => $lowongan->getId()->id(),
                'dosen_id' => $lowongan->getDosenId()->id(),
                'mata_kuliah_id' => $lowongan->getMataKuliahId()->id(),
                'kode_kelas' => $lowongan->getKodeKelas(),
                'gaji' => $lowongan->getGaji(),
                'tanggal_mulai' => $lowongan->getTanggalMulai()->format('y-m-d'),
                'tanggal_selesai' => $lowongan->getTanggalSelesai()->format('y-m-d'),
                'deskripsi' => $lowongan->getDeskripsi(),
                'terbuka' => $lowongan->getTerbuka() ? 'Y' : 'N',
                'created_at' => $lowongan->getCreatedAt()->format('y-m-d')
            ];
            
            $sql = "INSERT INTO lowongan (id, dosen_id, mata_kuliah_id, kode_kelas, gaji, tanggal_mulai, tanggal_selesai, deskripsi, terbuka, created_at)
                VALUES (:id, :dosen_id, :mata_kuliah_id, :kode_kelas, :gaji, :tanggal_mulai, :tanggal_selesai, :deskripsi, :terbuka, :created_at)";

            DB::insert($sql, $data);
        }
    }
    /**
     * Update Lowongan data in database.
     */
    public function update(Lowongan $lowongan) : void {
        $sql = "UPDATE lowongan
                SET dosen_id = :dosen_id, mata_kuliah_id = :mata_kuliah_id, kode_kelas = :kode_kelas, gaji = :gaji, tanggal_mulai = :tanggal_mulai, tanggal_selesai = :tanggal_selesai, deskripsi = :deskripsi, terbuka = :terbuka
                WHERE id = :id";
        
        $data = [
            'id' => $lowongan->getId()->id(),
            'dosen_id' => $lowongan->getDosenId()->id(),
            'mata_kuliah_id' => $lowongan->getMataKuliahId()->id(),
            'kode_kelas' => $lowongan->getKodeKelas(),
            'gaji' => $lowongan->getGaji(),
            'tanggal_mulai' => $lowongan->getTanggalMulai()->format('y-m-d'),
            'tanggal_selesai' => $lowongan->getTanggalSelesai()->format('y-m-d'),
            'deskripsi' => $lowongan->getDeskripsi(),
            'terbuka' => $lowongan->getTerbuka() ? 'Y' : 'N',
        ];

        DB::update($sql, $data);

        // Delete data from redis
        $redis_key = 'lowongan'.$lowongan->getId()->id();
        Redis::del($redis_key);
    }

    /**
     * Delete Lowongan from database.
     */
    public function delete(Lowongan $lowongan) : void {
        $sql = "DELETE FROM lowongan
                WHERE id = :id";
        $data = ['id' => $lowongan->getId()->id()];
        DB::delete($sql, $data);

        // Delete data from redis
        Redis::del('lowongan'.$lowonganId->id());
    }
}