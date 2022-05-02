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
    <h2>Daftar Pelamar</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('No.') }}</th>
                <th scope="col">{{ __('Tanggal') }}</th>
                <th scope="col">{{ __('Nama') }}</th>
                <th scope="col">{{ __('Status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftar_pelamar as $dp)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $dp->tanggal_melamar }}</td>
                <td>{{ $dp->nama_lengkap }}</td>
                <td>{{ $dp->diterima ? 'Diterima' : 'Pending' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
