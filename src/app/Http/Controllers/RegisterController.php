<?php

namespace App\Http\Controllers;

use App\Core\Application\Service\BuatDosen\BuatDosenRequest;
use App\Core\Application\Service\BuatDosen\BuatDosenService;
use App\Core\Domain\Exception\ApplicationServiceException;
use App\Core\Domain\Repository\DosenRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(
        private DosenRepository $dosenRepository
    ) {
    }

    /**
     * Show daftar page
     * 
     * @return \Illuminate\Http\Response
     */
    public function daftar(Request $request)
    {
        $peran = $request->input('peran');
        switch ($peran) {
            case 'dosen':
                return view('user.daftar-dosen');
                break;
            case 'mahasiswa':
                return view('user.daftar-mahasiswa');
                break;
        }
        return abort(404);
    }

    /**
     * Daftar Action
     */
    public function daftarAction(Request $request)
    {
    }
}
