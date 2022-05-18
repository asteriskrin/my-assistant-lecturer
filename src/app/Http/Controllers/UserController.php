<?php

namespace App\Http\Controllers;

use App\Core\Application\Service\UbahDosen\UbahDosenRequest;
use App\Core\Application\Service\UbahDosen\UbahDosenService;
use App\Core\Application\Service\UbahMahasiswa\UbahMahasiswaRequest;
use App\Core\Application\Service\UbahMahasiswa\UbahMahasiswaService;
use App\Core\Domain\Exception\ApplicationServiceException;
use App\Core\Domain\Model\DosenId;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Repository\DosenRepository;
use App\Core\Domain\Repository\MahasiswaRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        private MahasiswaRepository $mahasiswaRepository,
        private DosenRepository $dosenRepository,
    ) { }

    /**
     * Show ubah user page.
     */
    public function ubah()
    {
        $user = auth()->user();

        if(isset($user->nip)) {
            $dosen = $this->dosenRepository->byId(new DosenId($user->id));
            if (!$dosen) {
                return abort(404);
            }

            return view('user.ubah-dosen', [
                'namaLengkap' => $dosen->getNamaLengkap(),
                'nip' => $dosen->getNip(),
                'nomorTelepon' => $dosen->getNomorTelepon(),
                'email' => $dosen->getEmail(),
            ]);
        }
        
        if (isset($user->nim)) {
            $mahasiswa = $this->mahasiswaRepository->byId(new MahasiswaId($user->id));
            if (!$mahasiswa) {
                return abort(404);
            }

            return view('user.ubah-mahasiswa', [
                'namaLengkap' => $mahasiswa->getNamaLengkap(),
                'nim' => $mahasiswa->getNim(),
                'urlTranskripMk' => $mahasiswa->getUrlTranskripMk(),
                'ipk' => $mahasiswa->getIpk(),
                'semester' => $mahasiswa->getSemester(),
                'nomorRekening' => $mahasiswa->getNomorRekening(),
                'nomorTelepon' => $mahasiswa->getNomorTelepon(),
                'email' => $mahasiswa->getEmail(),
            ]);
        }

        return abort(404);
    }

    /**
     * Ubah user action
     */
    public function ubahAction(Request $request)
    {
        $user = auth()->user();

        $generalValidationRules = [
            'namaLengkap' => ['required', 'max:255'],
            'nomorTelepon' => ['required', 'numeric'],
            'password' => ['required', 'min:8'],
            'email' => []
        ];

        if ($request->input('email') != $user->email) {
            $generalValidationRules['email'] = ['required', 'email:dns', 'unique:user'];
        }

        if ($request->input('nip')) {
            $dosenValidationRules = $generalValidationRules;
            $dosenValidationRules['nip'] = [];

            if ($request->input('nip') != $user->nip) {
                $dosenValidationRules['nip'] = ['required', 'numeric', 'unique:user'];
            }

            $validatedData = $request->validate($dosenValidationRules);

            $ubahDosenRequest = new UbahDosenRequest(
                id: $user->id,
                namaLengkap: $validatedData['namaLengkap'],
                nip: $validatedData['nip'],
                nomorTelepon: $validatedData['nomorTelepon'],
                email: $validatedData['email'],
                password: Hash::make($validatedData['password'])
            );

            $ubahDosenService = new UbahDosenService(
                dosenRepository: $this->dosenRepository
            );

            try {
                $ubahDosenService->execute($ubahDosenRequest);
            } catch (ApplicationServiceException $e) {
                return back()->with('failed', 'Ubah profil gagal, ' . $e->getMessage());
            }

            return back()->with('success', 'Ubah profil berhasil');
        } else if ($request->input('nim')) {
            $mahasiswaValidationRules = array_merge(
                $generalValidationRules,
                [
                    'nim' => [],
                    'urlTranskripMk' => ['required', 'url'],
                    'ipk' => ['required', 'numeric', 'min:0', 'max:4'],
                    'semester' => ['required', 'numeric', 'min:1', 'max:14'],
                    'nomorRekening' => ['required', 'numeric'],
                ]
            );

            if ($request->input('nim') != $user->nim) {
                $mahasiswaValidationRules['nim'] = ['required', 'numeric', 'unique:user'];
            }

            $validatedData = $request->validate($mahasiswaValidationRules);

            $ubahMahasiswaRequest = new UbahMahasiswaRequest(
                id: $user->id,
                namaLengkap: $validatedData['namaLengkap'],
                nim: $validatedData['nim'],
                urlTranskripMk: $validatedData['urlTranskripMk'],
                ipk: $validatedData['ipk'],
                semester: $validatedData['semester'],
                nomorRekening: $validatedData['nomorRekening'],
                nomorTelepon: $validatedData['nomorTelepon'],
                email: $validatedData['email'],
                password: Hash::make($validatedData['password']),
            );

            $ubahMahasiswaService = new UbahMahasiswaService(
                mahasiswaRepository: $this->mahasiswaRepository
            );

            try {
                $ubahMahasiswaService->execute($ubahMahasiswaRequest);
            } catch (ApplicationServiceException $e) {
                return back()->with(
                    'failed',
                    'Ubah profil gagal, ' . $e->getMessage()
                );
            }

            return back()->with('success', 'Ubah profil berhasil');
        }

        return back()->with('failed', 'Ubah profil gagal, terjadi kesalahan');
    }
}
