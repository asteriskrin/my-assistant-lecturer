<?php

namespace App\Infrastructure\Query;

use App\Core\Application\Query\DaftarNotifikasi\DaftarNotifikasiDto;
use App\Core\Application\Query\DaftarNotifikasi\DaftarNotifikasiQueryInterface;
use App\Core\Domain\Model\Notifikasi;
use DB;
use DateTime;
use Illuminate\Support\Facades\Redis;

class SqlDaftarNotifikasiQuery implements DaftarNotifikasiQueryInterface {
    public function execute(string $mahasiswa_id) : array {
        // Get data from redis
        $redis_key = 'user:notifikasi'.$mahasiswa_id;
        $daftar_notifikasi = Redis::get($redis_key);
        if (Redis::exists($daftar_notifikasi)) {
            $daftar_notifikasi = [];
            foreach ($unserialized_notifikasi_list as $n) {
                $daftar_notifikasi[] = Notifikasi::unserialize($n);
            }
            return $daftar_notifikasi;
        }
        $sql = "SELECT n.id, n.mahasiswa_id, n.pesan, n.jenis, n.dibaca, u.nama_lengkap
            FROM notifikasi n
            INNER JOIN  user u ON u.id = n.mahasiswa_id
            WHERE n.mahasiswa_id = :mahasiswa_id
            ORDER BY n.id DESC 
            ";
        
        $result = DB::select($sql, ['mahasiswa_id' => $mahasiswa_id]);

        $daftar_notifikasi = array();

        foreach ($result as $notifikasi) {
            $daftar_notifikasi[] = new DaftarNotifikasiDto(
                id: $notifikasi->id,
                mahasiswa_id: $notifikasi->mahasiswa_id,
                jenis: $notifikasi->jenis,
                pesan: $notifikasi->pesan,
                dibaca: $notifikasi->dibaca
            );
        }

        // Write data to redis
        if (count($daftar_notifikasi) > 0) {
            Redis::set($redis_key, $daftar_notifikasi);
            Redis::expire($redis_key, 60*5);
        }

        return $daftar_notifikasi;
    }

    public function byId(string $notifikasi_id) : ?DaftarNotifikasiDto {
        $sql = "SELECT n.id, n.mahasiswa_id, n.pesan, n.jenis, n.dibaca, m.nama_lengkap
        FROM notifikasi n
        INNER JOIN mahasiswa m ON m.id = n.mahasiswa_id
            WHERE n.id = :Notifikasi_id
            ";

        $result = DB::select($sql, [
            'notifikasi_id' => $notifikasi_id
        ]);

        if ($result) {
            return new DaftarNotifikasiDto(
                id: $result[0]->id,
                mahasiswa_id: $result[0]->mahasiswa_id,
                jenis: $result[0]->jenis,
                pesan: $result[0]->pesan,
                dibaca: $result[0]->dibaca,
                nama_lengkap: $result[0]->nama_lengkap
            );
        }
        return null;
    }
}