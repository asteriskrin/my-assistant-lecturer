<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Domain\Repository\LowonganRepository;
use App\Core\Domain\Repository\MahasiswaRepository;
use App\Core\Domain\Repository\AsistenDosenRepository;
use App\Core\Domain\Repository\MataKuliahRepository;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Application\Service\BuatLamaran\BuatLamaranRequest;
use App\Core\Application\Service\BuatLamaran\BuatLamaranService;
use App\Core\Application\Service\UbahStatusAsistenDosen\UbahStatusAsistenDosenRequest;
use App\Core\Application\Service\UbahStatusAsistenDosen\UbahStatusAsistenDosenService;
use App\Core\Application\Query\DaftarLamaran\DaftarLamaranQueryInterface;
use App\Core\Application\Query\DaftarRiwayatAsistensi\DaftarRiwayatAsistensiQueryInterface;
use App\Jobs\BuatNotifikasiJob;
use Exception;

class AsistenDosenController extends Controller
{
    public function __construct(
        private DaftarLamaranQueryInterface $daftarLamaranQuery,
        private LowonganRepository $lowonganRepository,
        private MahasiswaRepository $mahasiswaRepository,
        private AsistenDosenRepository $asistenDosenRepository,
        private MataKuliahRepository $mataKuliahRepository,
        private UbahStatusAsistenDosenService $ubahStatusAsistenDosenService,
        private BuatLamaranService $buatLamaranService,
        private DaftarRiwayatAsistensiQueryInterface $daftarRiwayatAsistensiQuery
    ) { }

    public function lamar(string $lowonganId) {
        $lowonganId = new LowonganId($lowonganId);
        $lowongan = $this->lowonganRepository->byId($lowonganId);
        if (!$lowongan) return abort(404);
        $mahasiswaId = new MahasiswaId(auth()->user()->id);
        $mahasiswa = $this->mahasiswaRepository->byId($mahasiswaId);
        $mataKuliah = $this->mataKuliahRepository->byId($lowongan->getMataKuliahId());
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

        BuatNotifikasiJob::dispatch($lowongan->getDosenId()->id(), 'n', $mahasiswa->getNamaLengkap().' melamar di lowongan '.$mataKuliah->getKode().'. '.$mataKuliah->getNama().' '.$lowongan->getKodeKelas());

        return response()->redirectToRoute('lowongan')
            ->with('success', 'berhasil_melamar_ke_lowongan');
    }

    public function index() {
        $daftar_lamaran = $this->daftarLamaranQuery->execute(auth()->user()->id);
        return view('lamaran.index', [
            'daftar_lamaran' => $daftar_lamaran
        ]);
    }

    /**
     * Show page for ubah status pelamar
     */
    public function ubahStatusPelamar(string $lowonganId, string $mahasiswaId) {
        $lowonganId = new LowonganId($lowonganId);
        $mahasiswaId = new MahasiswaId($mahasiswaId);

        $lowongan = $this->lowonganRepository->byId($lowonganId);
        if (auth()->user()->id != $lowongan->getDosenId()->id()) return abort(403);

        $asistenDosen = $this->asistenDosenRepository->byId($lowonganId, $mahasiswaId);
        if (!$asistenDosen) return abort(404);
        $mahasiswa = $this->mahasiswaRepository->byId($mahasiswaId);

        return view('lamaran.ubah', [
            'asistenDosen' => $asistenDosen,
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Action for ubah status pelamar
     */
    public function ubahStatusPelamarAction(string $lowonganId, string $mahasiswaId, Request $request) {
        $request->validate([
            'diterima' => 'required|numeric|between:0,1',
            'dibayar' => 'required|numeric|between:0,1',
        ]);

        $lowonganId = new LowonganId($lowonganId);
        $mahasiswaId = new MahasiswaId($mahasiswaId);

        $lowongan = $this->lowonganRepository->byId($lowonganId);
        if (auth()->user()->id != $lowongan->getDosenId()->id()) return abort(403);

        $asistenDosen = $this->asistenDosenRepository->byId($lowonganId, $mahasiswaId);
        if (!$asistenDosen) return abort(404);

        $mataKuliah = $this->mataKuliahRepository->byId($lowongan->getMataKuliahId());

        $diterima = $request->diterima == 1 ? true : false;
        $dibayar = $request->dibayar == 1 ? true : false;
        $ubahRequest = new UbahStatusAsistenDosenRequest($mahasiswaId->id(), $lowonganId->id(), $diterima, $dibayar);

        try {
            $this->ubahStatusAsistenDosenService->execute($ubahRequest);
        }
        catch (Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
        if ($diterima && !$asistenDosen->getDiterima()) {
            BuatNotifikasiJob::dispatch($mahasiswaId->id(), 'n', 'Anda telah diterima di lowongan '.$mataKuliah->getKode().'. '.$mataKuliah->getNama().' '.$lowongan->getKodeKelas());
        }
        if ($dibayar && !$asistenDosen->getDibayar()) {
            BuatNotifikasiJob::dispatch($mahasiswaId->id(), 'n', 'Anda telah menerima honor dari lowongan '.$mataKuliah->getKode().'. '.$mataKuliah->getNama().' '.$lowongan->getKodeKelas());
        }
        return response()->redirectToRoute('ubah-status-pelamar', ['lowonganId' => $lowonganId->id(), 'mahasiswaId' => $mahasiswaId->id()])
            ->with('success', 'berhasil_mengubah_status_pelamar');
    }

    /**
     * Show page for lihat detail mahasiswa
     */
    public function lihatDetailMahasiswa(string $mahasiswa_id) {

        try {
            $mahasiswaId = new MahasiswaId($mahasiswa_id);
        } catch (Exception $e) {
            return abort(404);
        }
        
        $mahasiswa = $this->mahasiswaRepository->byId($mahasiswaId);
        if (!$mahasiswa) {
            return abort(404);
        }

        $daftarRiwayatAsistensi = $this->daftarRiwayatAsistensiQuery->execute($mahasiswa_id);

        return view('user.detail-mahasiswa', [
            'namaLengkap' => $mahasiswa->getNamaLengkap(),
            'nim' => $mahasiswa->getNim(),
            'urlTranskripMk' => $mahasiswa->getUrlTranskripMk(),
            'ipk' => $mahasiswa->getIpk(),
            'semester' => $mahasiswa->getSemester(),
            'nomorRekening' => $mahasiswa->getNomorRekening(),
            'nomorTelepon' => $mahasiswa->getNomorTelepon(),
            'email' => $mahasiswa->getEmail(),
            'riwayat_asistensi' => $daftarRiwayatAsistensi
        ]);
    }
}
