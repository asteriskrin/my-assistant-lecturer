<?php

namespace App\Infrastructure\Query;

use App\Core\Application\Query\DaftarLowongan\DaftarLowonganDto;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;
use DB;
use DateTime;

class SqlDaftarLowonganQuery implements DaftarLowonganQueryInterface {
    public function execute() : array {
        $sql = "SELECT l.kode_kelas, l.gaji, l.tanggal_mulai, l.tanggal_selesai, l.deskripsi, l.terbuka 
            FROM lowongan l
            INNER JOIN mata_kuliah mk ON mk.id = l.mata_kuliah_id
            INNER JOIN user u ON u.id = l.dosen_id
            ORDER BY l.id DESC 
            ";
        
        $result = DB::select($sql);

        $daftar_lowongan = array();

        foreach ($result as $lowongan) {
            $daftar_lowongan[] = new DaftarLowonganDto(
                kode_kelas: $lowongan->kode_kelas,
                gaji: $lowongan->gaji,
                tanggal_mulai: date_format(new DateTime($lowongan->tanggal_mulai), "d-m-Y"),
                tanggal_selesai: date_format(new DateTime($lowongan->tanggal_selesai), "d-m-Y"),
                deskripsi: $lowongan->deskripsi,
                terbuka: $lowongan->terbuka
            );
        }

        return $daftar_lowongan;
    }
}