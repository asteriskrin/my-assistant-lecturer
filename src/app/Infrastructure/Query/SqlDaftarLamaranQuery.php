<?php

namespace App\Infrastructure\Query;

use App\Core\Application\Query\DaftarLamaran\DaftarLamaranDto;
use App\Core\Application\Query\DaftarLamaran\DaftarLamaranQueryInterface;
use DB;
use DateTime;

class SqlDaftarLamaranQuery implements DaftarLamaranQueryInterface {
    public function execute(string $mahasiswa_id) : array {
        $sql = "SELECT l.id, l.dosen_id, l.mata_kuliah_id, l.kode_kelas, l.gaji, l.tanggal_mulai, l.tanggal_selesai, l.deskripsi, l.terbuka, mk.nama as mata_kuliah_nama, ad.diterima as lamaran_diterima, ad.dibayar as lamaran_dibayar, ad.created_at as lamaran_created_at 
            FROM lowongan l
            INNER JOIN mata_kuliah mk ON mk.id = l.mata_kuliah_id
            INNER JOIN asisten_dosen ad ON ad.lowongan_id = l.id
            WHERE ad.mahasiswa_id = :mahasiswa_id
            ORDER BY ad.created_at DESC
            ";
        
        $result = DB::select($sql, ['mahasiswa_id' => $mahasiswa_id]);

        $daftar_lamaran = array();

        foreach ($result as $r) {
            $daftar_lamaran[] = new DaftarLamaranDto(
                id: $r->id,
                dosen_id: $r->dosen_id,
                mata_kuliah_id: $r->mata_kuliah_id,
                kode_kelas: $r->kode_kelas,
                gaji: $r->gaji,
                tanggal_mulai: date_format(new DateTime($r->tanggal_mulai), "Y-m-d"),
                tanggal_selesai: date_format(new DateTime($r->tanggal_selesai), "Y-m-d"),
                deskripsi: $r->deskripsi,
                terbuka: $r->terbuka,
                mata_kuliah_nama: $r->mata_kuliah_nama,
                lamaran_diterima: $r->lamaran_diterima == 'Y' ? true : false,
                lamaran_dibayar: $r->lamaran_dibayar == 'Y' ? true : false,
                lamaran_created_at: date_format(new DateTime($r->lamaran_created_at), "Y-m-d H:i:s")
            );
        }

        return $daftar_lamaran;
    }
}