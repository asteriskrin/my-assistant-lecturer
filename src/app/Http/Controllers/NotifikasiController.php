<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Domain\Repository\NotifikasiRepository;
use App\Core\Domain\Model\NotifikasiId;
use App\Core\Application\Service\BuatNotifikasi\BuatNotifikasiService;
use App\Core\Application\Service\BuatNotifikasi\BuatNotifikasiRequest;
use App\Core\Application\Query\DaftarNotifikasi\DaftarNotifikasiQueryInterface;

class NotifikasiController extends Controller
{
    public function __construct(
        private DaftarNotifikasiQueryInterface $daftarNotifikasiQuery
    ) { }

    // public function index() {
    //     // $daftar_lowongan = $this->daftarLowonganQuery->execute();
    //     return view('notifikasi.index');
    // }
    
    public function index() {
        $daftar_notifikasi = $this->daftarNotifikasiQuery->execute(auth()->user()->id);
        return view('notifikasi.index', [
            'daftar_notifikasi' => $daftar_notifikasi
        ]);
    }
}
