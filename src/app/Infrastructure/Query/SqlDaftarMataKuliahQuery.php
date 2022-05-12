<?php

namespace App\Infrastructure\Query;

use App\Core\Application\Query\DaftarMataKuliah\DaftarMataKuliahDto;
use App\Core\Application\Query\DaftarMataKuliah\DaftarMataKuliahQueryInterface;
use DB;
use DateTime;

class SqlDaftarMataKuliahQuery implements DaftarMataKuliahQueryInterface {
    public function execute() : array {
        $sql = "SELECT id, nama, semester, kode FROM mata_kuliah";
        
        $result = DB::select($sql);

        $daftar_mata_kuliah = array();

        foreach ($result as $mata_kuliah) {
            $daftar_mata_kuliah[] = new DaftarMataKuliahDto(
                id: $mata_kuliah->id,
                nama: $mata_kuliah->nama,
                semester: $mata_kuliah->semester,
                kode: $mata_kuliah->kode
            );
        }

        return $daftar_mata_kuliah;
    }
}