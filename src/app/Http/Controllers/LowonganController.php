<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Domain\Model\Lowongan;
use DateTime;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;

class LowonganController extends Controller
{
    public function __construct(
        public DaftarLowonganQueryInterface $daftarLowonganQuery
    ) { }

    /**
     * Show a list of all available Lowongan.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $daftar_lowongan = $this->daftarLowonganQuery->execute();
        return view('lowongan.index', [
            'daftar_lowongan' => $daftar_lowongan
        ]);
    }
}
