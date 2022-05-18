{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Detail Lowongan')
@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-block" role="alert">
            {{ ucfirst(str_replace('_', ' ', session('success'))) . '.' }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('failed'))
        <div class="alert alert-danger alert-dismissible fade show d-block" role="alert">
            {{ ucfirst(str_replace('_', ' ', session('failed'))) . '.' }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>{{ $mataKuliah->getNama() }} {{ $lowongan->getKodeKelas() }}</h1>
    <p>{{ __('Deskripsi') }}</p>
    <p>{{ $lowongan->getDeskripsi() }}</p>
    <p>{{ __('Gaji') }}</p>
    <p>Rp{{ $lowongan->getGaji() }}</p>
    <p>{{ __('Kode Mata Kuliah') }}</p>
    <p>{{ $mataKuliah->getKode() }}</p>
    <p>{{ __('Dosen') }}</p>
    <p>{{ $dosen->getNamaLengkap() }}</p>
    <p>{{ __('Periode') }}</p>
    <p>{{ $lowongan->getTanggalMulai()->format('d M Y') }} s/d {{ $lowongan->getTanggalSelesai()->format('d M Y') }}</p>
    @if ($lowongan->getTerbuka())
        <div class="alert alert-success">{{ __('Lowongan Terbuka') }}</div>
        @if (auth()->check() && auth()->user()->id == $lowongan->getDosenId()->id())
        <form method="POST" action="{{ route('tutup-lowongan', ['lowonganId' => $lowongan->getId()->id()]) }}">
            @csrf
            <button type="submit" class="btn btn-danger">Tutup Lowongan</button>
        </form>
        @endif
    @else
        <div class="alert alert-danger">{{ __('Lowongan ini sudah ditutup.') }}</div>
    @endif
    <h2>Daftar Pelamar</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('No.') }}</th>
                <th scope="col">{{ __('Tanggal') }}</th>
                <th scope="col">{{ __('Nama') }}</th>
                <th scope="col">{{ __('Status') }}</th>
                <th scope="col">{{ __('Status Pembayaran') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftar_pelamar as $dp)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $dp->tanggal_melamar }}</td>
                <td>{{ $dp->nama_lengkap }}</td>
                <td>{{ $dp->diterima ? 'Diterima' : ($lowongan->getTerbuka() ? 'Pending' : 'Tidak diterima') }}</td>
                <td>{{ $dp->dibayar ? 'Lunas' : 'Belum lunas' }}</td>
                @if (auth()->check() && auth()->user()->id == $lowongan->getDosenId()->id())
                    <td><a href="{{ route('ubah-status-pelamar', ['lowonganId' => $lowongan->getId()->id(), 'mahasiswaId' => $dp->user_id]) }}" class="btn btn-primary btn-sm" onclick="ubah({{ $loop->index }})">{{ __('Ubah') }}</a></td>
                    <td><a href="{{ route('detail-mahasiswa', ['mahasiswaId' => $dp->user_id]) }}" class="btn btn-primary btn-sm">Lihat Detail</a></td>
                @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
