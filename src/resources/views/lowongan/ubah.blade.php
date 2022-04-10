@extends('layouts.app')
@section('title', 'Edit Lowongan')
@section('content')
    <form method="POST" action="{{ route('ubah-lowongan', ['lowonganId' => $lowongan->id]) }}">
        @csrf
        <input type="text" name="id" value="{{ $lowongan->id }}" hidden>
        <input type="text" name="dosen_id" placeholder="Dosen ID" value="{{ $lowongan->dosen_id }}"><br>
        <input type="text" name="mata_kuliah_id" placeholder="Mata Kuliah ID" value="{{ $lowongan->mata_kuliah_id }}"><br>
        <input type="text" name="kode_kelas" placeholder="Kode Kelas" value="{{ $lowongan->kode_kelas }}"><br>
        <input type="text" name="gaji" placeholder="Gaji" value="{{ $lowongan->gaji }}"><br>
        <input type="date" name="tanggal_mulai" value="{{ $lowongan->tanggal_mulai }}"><br>
        <input type="date" name="tanggal_selesai" value="{{ $lowongan->tanggal_selesai }}"><br>
        <textarea name="deskripsi" placeholder="Deskripsi">{{ $lowongan->deskripsi }}</textarea><br>
        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('lowongan') }}">{{ __('Daftar Lowongan') }}</a>
@endsection
