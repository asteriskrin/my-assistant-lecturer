<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Domain\Model\Lowongan;
use DateTime;
use App\Core\Application\Query\DaftarMataKuliah\DaftarMataKuliahQueryInterface;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;
use App\Core\Application\Service\BuatLowongan\BuatLowonganRequest;
use App\Core\Application\Service\BuatLowongan\BuatLowonganService;
use App\Core\Application\Service\UbahLowongan\UbahLowonganRequest;
use App\Core\Application\Service\UbahLowongan\UbahLowonganService;
use App\Core\Application\Service\HapusLowongan\HapusLowonganRequest;
use App\Core\Application\Service\HapusLowongan\HapusLowonganService;
use App\Core\Domain\Repository\LowonganRepository;

class LowonganController extends Controller
{
    public function __construct(
        private DaftarLowonganQueryInterface $daftarLowonganQuery,
        private DaftarMataKuliahQueryInterface $daftarMataKuliahQuery,
        private LowonganRepository $lowonganRepository,
        private UbahLowonganService $ubahLowonganService,
        private HapusLowonganService $hapusLowonganService
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
        $daftar_mata_kuliah = $this->daftarMataKuliahQuery->execute();
        return view('lowongan.tambah', [
            'daftar_mata_kuliah' => $daftar_mata_kuliah
        ]);
    }

    /**
     * Show Ubah Lowongan page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function ubah($lowonganId) {
        // TODO: Add authentication

        $lowongan = $this->daftarLowonganQuery->byId($lowonganId);
        
        if (!$lowongan) {
            return abort(404);
        }

        if (auth()->user()->id != $lowongan->dosen_id) return abort(403);

        $daftar_mata_kuliah = $this->daftarMataKuliahQuery->execute();
        
        return view('lowongan.ubah', [
            'lowongan' => $lowongan,
            'daftar_mata_kuliah' => $daftar_mata_kuliah
        ]);
    }

    /**
     * Tambah Lowongan Action
     */
    public function tambahAction(Request $request) {
        // TODO: Add authentication

        $dosenId = auth()->user()->id;
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

    /**
     * Ubah Lowongan Action
     */
    public function ubahAction(string $lowonganId, Request $request) {
        // TODO: Add authentication

        $lowongan = $this->daftarLowonganQuery->byId($lowonganId);

        if (!$lowongan) {
            return abort(404);
        }

        if (auth()->user()->id != $lowongan->dosen_id) return abort(403);

        $id = $lowongan->id;
        $dosenId = $lowongan->dosen_id;
        $mataKuliahId = $request->input('mata_kuliah_id');
        $kodeKelas = $request->input('kode_kelas');
        $gaji = $request->input('gaji');
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $deskripsi = $request->input('deskripsi');

        $ubahRequest = new UbahLowonganRequest(
            $id,
            $dosenId,
            $mataKuliahId,
            $kodeKelas,
            $gaji,
            $tanggal_mulai,
            $tanggal_selesai,
            $deskripsi
        );

        try {
            $this->ubahLowonganService->execute($ubahRequest);
        }
        catch (Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        return response()->redirectToRoute('lowongan')
            ->with('success', 'berhasil_mengubah_lowongan');
    }

    public function deleteAction(string $lowonganId) {
        // TODO: Add authentication

        $lowongan = $this->daftarLowonganQuery->byId($lowonganId);

        if (!$lowongan) {
            return abort(404);
        }

        if (auth()->user()->id != $lowongan->dosen_id) return abort(403);

        $hapusRequest = new HapusLowonganRequest($lowonganId);
        try {
            $this->hapusLowonganService->execute($hapusRequest);
        }
        catch (Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        return response()->redirectToRoute('lowongan')
            ->with('success', 'berhasil_menghapus_lowongan');
    }
}
