<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show masuk page
     * 
     * @return \Illuminate\Http\Response
     */
    public function masuk()
    {
        return view('user.masuk');
    }

    /**
     * Masuk Action
     */
    public function authenticate(Request $request)
    {
        $masukSebagai = $request->input('masukSebagai');
        $identitas = null;

        switch ($masukSebagai) {
            case 'dosen':
                $identitas = 'nip';
                break;
            case 'mahasiswa':
                $identitas = 'nim';
                break;
            default:
                return back()->with('failed', 'Masuk gagal, terjadi kesalahan');
        }

        $credentials = $request->validate([
            'nomorIdentitas' => ['required', 'numeric'],
            'password' => ['required', 'min:8'],
        ]);

        $credentials[$identitas] = $credentials['nomorIdentitas'];
        unset($credentials['nomorIdentitas']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('failed', 'Maaf, nomor identitas atau password anda salah. Mohon periksa kembali.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
