<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Core\Domain\Model\MataKuliahId;
use DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create Mata Kuliah
         */
        $listMataKuliah = [
            [
                "nama" => "Pemrograman Berbasis Kerangka Kerja",
                "semester" => 6,
                "kode" => "IF192344"
            ],
            [
                "nama" => "Dasar Pemrograman",
                "semester" => 1,
                "kode" => "IF923344"
            ],
            [
                "nama" => "Struktur Data",
                "semester" => 2,
                "kode" => "IF923344"
            ],
            [
                "nama" => "Komputasi Awan",
                "semester" => 6,
                "kode" => "IF234455"
            ]
        ];
        foreach ($listMataKuliah as $mk) {
            $mataKuliahId = MataKuliahId::make();
            $data = [
                'id' => $mataKuliahId->id(),
                'nama' => $mk['nama'],
                'semester' => $mk['semester'],
                'kode' => $mk['kode']
            ];
            
            $sql = "INSERT INTO mata_kuliah (id, nama, semester, kode)
                VALUES (:id, :nama, :semester, :kode)";

            DB::insert($sql, $data);
        }
    }
}
