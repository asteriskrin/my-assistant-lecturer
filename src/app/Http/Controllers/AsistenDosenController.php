<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Domain\Repository\LowonganRepository;
use App\Core\Domain\Repository\AsistenDosenRepository;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Application\Service\BuatLamaran\BuatLamaranRequest;
use App\Core\Application\Service\BuatLamaran\BuatLamaranService;
use App\Core\Application\Query\DaftarLamaran\DaftarLamaranQueryInterface;

class AsistenDosenController extends Controller
{
    public function __construct(
        private DaftarLamaranQueryInterface $daftarLamaranQuery,
        private LowonganRepository $lowonganRepository,
        private AsistenDosenRepository $asistenDosenRepository,
        private BuatLamaranService $buatLamaranService
    ) { }

    public function lamar(string $lowonganId) {
        $lowonganId = new LowonganId($lowonganId);
        $lowongan = $this->lowonganRepository->byId($lowonganId);
        if (!$lowongan) return abort(404);
        $mahasiswaId = new MahasiswaId(auth()->user()->id);
        $asistenDosen = $this->asistenDosenRepository->byId($lowonganId, $mahasiswaId);
        if ($asistenDosen) {
            return response()->redirectTo(route('lowongan'))
                ->with('failed', 'anda_sudah_melamar_di_lowongan_tersebut');
        }
        $buatRequest = new BuatLamaranRequest(
            $lowonganId->id(),
            $mahasiswaId->id(),
            false,
            false
        );

        try {
            $this->buatLamaranService->execute($buatRequest);
        }
        catch (Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        return response()->redirectToRoute('lowongan')
            ->with('success', 'berhasil_melamar_ke_lowongan');
    }

    public function index() {
        $daftar_lamaran = $this->daftarLamaranQuery->execute(auth()->user()->id);
        return view('lamaran.index', [
            'daftar_lamaran' => $daftar_lamaran
        ]);
    }
}
