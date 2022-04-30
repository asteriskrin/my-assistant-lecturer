<?php

namespace App\Http\Controllers;

use App\Core\Application\Service\BuatDosen\BuatDosenRequest;
use App\Core\Application\Service\BuatDosen\BuatDosenService;
use App\Core\Domain\Exception\ApplicationServiceException;
use App\Core\Domain\Repository\DosenRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $validatedData = $request->validate([
            'namaLengkap' => ['required', 'max:255'],
            'nomorTelepon' => ['required', 'numeric'],
            'email' => ['required', 'email:dns', 'unique:user'], // harus unik dan diperiksa di tabel 'user'
            'password' => ['required', 'min:8'],
            'nip' => ['numeric', 'unique:user'], // harus unik dan diperiksa di tabel 'user'
            'nim' => ['numeric', 'unique:user'] // harus unik dan diperiksa di tabel 'user'
        ]);

        // Ambil atribut wajib
        $namaLengkap = $validatedData['namaLengkap'];
        $nomorTelepon = $validatedData['nomorTelepon'];
        $email = $validatedData['email'];
        $password = Hash::make($validatedData['password']);

        // Ambil nomor identifikasi untuk menentukan peran user
        $nim = $request->input('nim');
        $nip = $request->input('nip');

        if ($nip) { // Jika daftar sebagai dosen
            $buatDosenRequest = new BuatDosenRequest(
                $namaLengkap,
                $nip,
                $nomorTelepon,
                $email,
                $password
            );

            $service = new BuatDosenService(
                dosenRepository: $this->dosenRepository
            );

            try {
                $service->execute($buatDosenRequest);
            } catch (ApplicationServiceException $e) {
                return back()->with('failed', 'Pendaftaran gagal, ' . $e->getMessage());
            }

            return redirect('/masuk')->with('success', 'Pendaftaran berhasil, silakan masuk');
        } else if ($nim) { // Jika daftar sebagai mahasiswa
            dd($request->all());
            // $urlTranskripMk = $request->input('urlTranskripMk');
            // $ipk = $request->input('ipk');
            // $semester = $request->input('semester');
            // $nomorRekening = $request->input('nomorRekening');
        }

        return back()->with('failed', 'Pendaftaran gagal, terjadi kesalahan');
    }
}
