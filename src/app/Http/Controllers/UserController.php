<?php

namespace App\Http\Controllers;

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
        ];

        if ($request->input('email') != $user->email) {
            $generalValidationRules['email'] = ['required', 'email:dns', 'unique:user'];
        }

        if ($request->input('nip')) { // Jika daftar sebagai dosen
            $dosenValidationRules = $generalValidationRules;

            if ($request->input('nip') != $user->nip) {
                $dosenValidationRules['nip'] = ['required', 'numeric', 'unique:user'];
            }

            $validatedData = $request->validate($dosenValidationRules);

            // $buatDosenRequest = new BuatDosenRequest(
            //     namaLengkap: $validatedData['namaLengkap'],
            //     nip: $validatedData['nip'],
            //     nomorTelepon: $validatedData['nomorTelepon'],
            //     email: $validatedData['email'],
            //     password: Hash::make($validatedData['password'])
            // );

            // $buatDosenService = new BuatDosenService(
            //     dosenRepository: $this->dosenRepository
            // );

            // try {
            //     $buatDosenService->execute($buatDosenRequest);
            // } catch (ApplicationServiceException $e) {
            //     return back()->with('failed', 'Pendaftaran gagal, ' . $e->getMessage());
            // }

            // return redirect('/masuk')->with('success', 'Pendaftaran berhasil, silakan masuk');
        } else if ($request->input('nim')) { // Jika daftar sebagai mahasiswa
            $mahasiswaValidationRules = array_merge(
                $generalValidationRules,
                [
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

            // $buatMahasiswaRequest = new BuatMahasiswaRequest(
            //     namaLengkap: $validatedData['namaLengkap'],
            //     nim: $validatedData['nim'],
            //     urlTranskripMk: $validatedData['urlTranskripMk'],
            //     ipk: $validatedData['ipk'],
            //     semester: $validatedData['semester'],
            //     nomorRekening: $validatedData['nomorRekening'],
            //     nomorTelepon: $validatedData['nomorTelepon'],
            //     email: $validatedData['email'],
            //     password: Hash::make($validatedData['password']),
            // );

            // $buatMahasiswaService = new BuatMahasiswaService(
            //     mahasiswaRepository: $this->mahasiswaRepository
            // );

            // try {
            //     $buatMahasiswaService->execute($buatMahasiswaRequest);
            // } catch (ApplicationServiceException $e) {
            //     return back()->with(
            //         'failed',
            //         'Pendaftaran gagal, ' . $e->getMessage()
            //     );
            // }

            // return redirect('/masuk')->with('success', 'Pendaftaran berhasil, silakan masuk');
        }

        return back()->with('failed', 'Pendaftaran gagal, terjadi kesalahan');
    }
}
