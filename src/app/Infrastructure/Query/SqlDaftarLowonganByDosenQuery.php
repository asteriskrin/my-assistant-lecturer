<?php

namespace App\Infrastructure\Query;

use App\Core\Application\Query\DaftarLowonganByDosen\DaftarLowonganByDosenDto;
use App\Core\Application\Query\DaftarLowonganByDosen\DaftarLowonganByDosenQueryInterface;
use DB;
use DateTime;

class SqlDaftarLowonganByDosenQuery implements DaftarLowonganByDosenQueryInterface {
    public function execute(string $dosen_id) : array {
        $sql = "SELECT l.id, l.dosen_id, l.mata_kuliah_id, l.kode_kelas, l.gaji, l.tanggal_mulai, l.tanggal_selesai, l.deskripsi, l.terbuka, mk.nama as mata_kuliah_nama 
            FROM lowongan l
            INNER JOIN mata_kuliah mk ON mk.id = l.mata_kuliah_id
            INNER JOIN user u ON u.id = l.dosen_id
            WHERE u.id = :dosen_id
            ORDER BY l.id DESC 
            ";
        
        $result = DB::select($sql, [
            'dosen_id' => $dosen_id
        ]);

        $daftar_lowongan = array();

        foreach ($result as $lowongan) {
            $daftar_lowongan[] = new DaftarLowonganByDosenDto(
                id: $lowongan->id,
                dosen_id: $lowongan->dosen_id,
                mata_kuliah_id: $lowongan->mata_kuliah_id,
                kode_kelas: $lowongan->kode_kelas,
                gaji: $lowongan->gaji,
                tanggal_mulai: date_format(new DateTime($lowongan->tanggal_mulai), "Y-m-d"),
                tanggal_selesai: date_format(new DateTime($lowongan->tanggal_selesai), "Y-m-d"),
                deskripsi: $lowongan->deskripsi,
                terbuka: $lowongan->terbuka,
                mata_kuliah_nama: $lowongan->mata_kuliah_nama
            );
        }

        return $daftar_lowongan;
    }
}