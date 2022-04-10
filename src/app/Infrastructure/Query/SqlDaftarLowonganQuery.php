<?php

namespace App\Infrastructure\Query;

use App\Core\Application\Query\DaftarLowongan\DaftarLowonganDto;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;
use DB;
use DateTime;

class SqlDaftarLowonganQuery implements DaftarLowonganQueryInterface {
    public function execute() : array {
        $sql = "SELECT l.id, l.dosen_id, l.mata_kuliah_id, l.kode_kelas, l.gaji, l.tanggal_mulai, l.tanggal_selesai, l.deskripsi, l.terbuka 
            FROM lowongan l
            INNER JOIN mata_kuliah mk ON mk.id = l.mata_kuliah_id
            INNER JOIN user u ON u.id = l.dosen_id
            ORDER BY l.id DESC 
            ";
        
        $result = DB::select($sql);

        $daftar_lowongan = array();

        foreach ($result as $lowongan) {
            $daftar_lowongan[] = new DaftarLowonganDto(
                id: $lowongan->id,
                dosen_id: $lowongan->dosen_id,
                mata_kuliah_id: $lowongan->mata_kuliah_id,
                kode_kelas: $lowongan->kode_kelas,
                gaji: $lowongan->gaji,
                tanggal_mulai: date_format(new DateTime($lowongan->tanggal_mulai), "Y-m-d"),
                tanggal_selesai: date_format(new DateTime($lowongan->tanggal_selesai), "Y-m-d"),
                deskripsi: $lowongan->deskripsi,
                terbuka: $lowongan->terbuka
            );
        }

        return $daftar_lowongan;
    }

    public function byId(string $lowongan_id) : ?DaftarLowonganDto {
        $sql = "SELECT id, dosen_id, mata_kuliah_id, kode_kelas, gaji, tanggal_mulai, tanggal_selesai, deskripsi, terbuka, created_at
                FROM lowongan
                WHERE id = :lowongan_id";

        $result = DB::select($sql, [
            'lowongan_id' => $lowongan_id
        ]);

        if ($result) {
            return new DaftarLowonganDto(
                id: $result[0]->id,
                dosen_id: $result[0]->dosen_id,
                mata_kuliah_id: $result[0]->mata_kuliah_id,
                kode_kelas: $result[0]->kode_kelas,
                gaji: $result[0]->gaji,
                tanggal_mulai: date_format(new DateTime($result[0]->tanggal_mulai), "Y-m-d"),
                tanggal_selesai: date_format(new DateTime($result[0]->tanggal_selesai), "Y-m-d"),
                deskripsi: $result[0]->deskripsi,
                terbuka: $result[0]->terbuka == 'Y' ? true : false
            );
        }
        return null;
    }
}