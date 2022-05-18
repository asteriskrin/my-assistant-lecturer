<?php

namespace App\Infrastructure\Query;

use App\Core\Application\Query\DaftarRiwayatAsistensi\DaftarRiwayatAsistensiDto;
use App\Core\Application\Query\DaftarRiwayatAsistensi\DaftarRiwayatAsistensiQueryInterface;
use DateTime;
use Illuminate\Support\Facades\DB;

class SqlDaftarRiwayatAsistensiQuery implements DaftarRiwayatAsistensiQueryInterface
{
    public function execute(string $mahasiswa_id): array
    {
        $sql = "SELECT l.id, mk.nama as mata_kuliah_nama, l.kode_kelas, l.gaji, l.tanggal_mulai, l.tanggal_selesai 
            FROM lowongan l
            INNER JOIN mata_kuliah mk ON mk.id = l.mata_kuliah_id
            INNER JOIN asisten_dosen ad ON ad.lowongan_id = l.id 
            WHERE ad.mahasiswa_id = :mahasiswa_id AND ad.diterima = 'Y'
            ORDER BY ad.created_at DESC 
            ";

        $result = DB::select($sql, ['mahasiswa_id' => $mahasiswa_id]);

        $daftar_riwayat_asistensi = array();

        foreach ($result as $r) {
            $daftar_riwayat_asistensi[] = new DaftarRiwayatAsistensiDto(
                id: $r->id,
                mata_kuliah_nama: $r->mata_kuliah_nama,
                kode_kelas: $r->kode_kelas,
                gaji: $r->gaji,
                tanggal_mulai: date_format(new DateTime($r->tanggal_mulai), "Y-m-d"),
                tanggal_selesai: date_format(new DateTime($r->tanggal_selesai), "Y-m-d"),
            );
        }

        return $daftar_riwayat_asistensi;
    }
}
