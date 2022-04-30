<?php

namespace App\Http\Controllers;

use App\Core\Application\Service\BuatDosen\BuatDosenRequest;
use App\Core\Application\Service\BuatDosen\BuatDosenService;
use App\Core\Application\Service\BuatMahasiswa\BuatMahasiswaRequest;
use App\Core\Application\Service\BuatMahasiswa\BuatMahasiswaService;
use App\Core\Domain\Exception\ApplicationServiceException;
use App\Core\Domain\Repository\DosenRepository;
use App\Core\Domain\Repository\MahasiswaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(
        private DosenRepository $dosenRepository,
        private MahasiswaRepository $mahasiswaRepository
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
        $generalValidationRules = [
            'namaLengkap' => ['required', 'max:255'],
            'nomorTelepon' => ['required', 'numeric'],
            'email' => ['required', 'email:dns', 'unique:user'], // harus unik dan diperiksa di tabel 'user'
            'password' => ['required', 'min:8'],
        ];

        if ($request->input('nip')) { // Jika daftar sebagai dosen
            $dosenValidationRules = array_merge(
                $generalValidationRules,
                [
                    'nip' => ['required', 'numeric', 'unique:user']
                ]
            );
            $validatedData = $request->validate($dosenValidationRules);

            $buatDosenRequest = new BuatDosenRequest(
                namaLengkap: $validatedData['namaLengkap'],
                nip: $validatedData['nip'],
                nomorTelepon: $validatedData['nomorTelepon'],
                email: $validatedData['email'],
                password: Hash::make($validatedData['password'])
            );

            $buatDosenService = new BuatDosenService(
                dosenRepository: $this->dosenRepository
            );

            try {
                $buatDosenService->execute($buatDosenRequest);
            } catch (ApplicationServiceException $e) {
                return back()->with('failed', 'Pendaftaran gagal, ' . $e->getMessage());
            }

            return redirect('/masuk')->with('success', 'Pendaftaran berhasil, silakan masuk');
        } else if ($request->input('nim')) { // Jika daftar sebagai mahasiswa
            $mahasiswaValidationRules = array_merge(
                $generalValidationRules,
                [
                    'nim' => ['required', 'numeric', 'unique:user'], // harus unik dan diperiksa di tabel 'user'
                    'urlTranskripMk' => ['required', 'url'],
                    'ipk' => ['required', 'numeric', 'min:0', 'max:4'],
                    'semester' => ['required', 'numeric', 'min:1', 'max:14'],
                    'nomorRekening' => ['required', 'numeric'],
                ]
            );
            $validatedData = $request->validate($mahasiswaValidationRules);

            $buatMahasiswaRequest = new BuatMahasiswaRequest(
                namaLengkap: $validatedData['namaLengkap'],
                nim: $validatedData['nim'],
                urlTranskripMk: $validatedData['urlTranskripMk'],
                ipk: $validatedData['ipk'],
                semester: $validatedData['semester'],
                nomorRekening: $validatedData['nomorRekening'],
                nomorTelepon: $validatedData['nomorTelepon'],
                email: $validatedData['email'],
                password: $validatedData['password'],
            );

            $buatMahasiswaService = new BuatMahasiswaService(
                mahasiswaRepository: $this->mahasiswaRepository
            );

            try {
                $buatMahasiswaService->execute($buatMahasiswaRequest);
            } catch (ApplicationServiceException $e) {
                return back()->with(
                    'failed',
                    'Pendaftaran gagal, ' . $e->getMessage()
                );
            }

            return redirect('/masuk')->with('success', 'Pendaftaran berhasil, silakan masuk');
        }

        return back()->with('failed', 'Pendaftaran gagal, terjadi kesalahan');
    }
}
