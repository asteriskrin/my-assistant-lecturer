<?php

namespace App\Infrastructure\Query;

use App\Core\Application\Query\DaftarPelamar\DaftarPelamarDto;
use App\Core\Application\Query\DaftarPelamar\DaftarPelamarQueryInterface;
use DB;
use DateTime;

class SqlDaftarPelamarQuery implements DaftarPelamarQueryInterface {
    public function execute(string $lowongan_id) : array {
        $sql = "SELECT u.id as user_id, u.nama_lengkap as user_nama_lengkap, ad.diterima as lamaran_diterima, ad.created_at as lamaran_created_at 
            FROM lowongan l
            INNER JOIN mata_kuliah mk ON mk.id = l.mata_kuliah_id
            INNER JOIN asisten_dosen ad ON ad.lowongan_id = l.id 
            INNER JOIN user u ON u.id = ad.mahasiswa_id
            WHERE l.id = :lowongan_id
            ORDER BY ad.created_at DESC 
            ";
        
        $result = DB::select($sql, ['lowongan_id' => $lowongan_id]);

        $daftar_pelamar = array();

        foreach ($result as $r) {
            $daftar_pelamar[] = new DaftarPelamarDto(
                user_id: $r->user_id,
                nama_lengkap: $r->user_nama_lengkap,
                diterima: $r->lamaran_diterima == 'Y' ? true : false,
                tanggal_melamar: $r->lamaran_created_at
            );
        }

        return $daftar_pelamar;
    }
}