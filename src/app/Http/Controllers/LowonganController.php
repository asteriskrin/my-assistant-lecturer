<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Domain\Model\Lowongan;
use DateTime;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;
use App\Core\Application\Service\BuatLowongan\BuatLowonganRequest;
use App\Core\Application\Service\BuatLowongan\BuatLowonganService;
use App\Core\Domain\Repository\LowonganRepository;

class LowonganController extends Controller
{
    public function __construct(
        private DaftarLowonganQueryInterface $daftarLowonganQuery,
        private LowonganRepository $lowonganRepository
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

    /**
     * Show Tambah Lowongan page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function tambah() {
        // TODO: Add authentication

        return view('lowongan.tambah');
    }

    /**
     * Tambah Lowongan Action
     */
    public function tambahAction(Request $request) {
        // TODO: Add authentication

        $dosenId = $request->input('dosen_id');
        $mataKuliahId = $request->input('mata_kuliah_id');
        $kodeKelas = $request->input('kode_kelas');
        $gaji = $request->input('gaji');
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $deskripsi = $request->input('deskripsi');

        $tambahRequest = new BuatLowonganRequest(
            $dosenId,
            $mataKuliahId,
            $kodeKelas,
            $gaji,
            $tanggal_mulai,
            $tanggal_selesai,
            $deskripsi
        );

        $service = new BuatLowonganService(
            lowonganRepository: $this->lowonganRepository
        );

        $service->execute($tambahRequest);

        return response()->redirectTo(route('lowongan'))
            ->with('success', 'berhasil_membuat_lowongan');
    }
}
