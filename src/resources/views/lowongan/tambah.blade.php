@extends('layouts.app')
@section('title', 'Tambah Lowongan')
@section('content')
    <form method="POST" action="{{ route('tambah-lowongan') }}">
        @csrf
        <input type="text" name="dosen_id" placeholder="Dosen ID"><br>
        <input type="text" name="mata_kuliah_id" placeholder="Mata Kuliah ID"><br>
        <input type="text" name="kode_kelas" placeholder="Kode Kelas"><br>
        <input type="text" name="gaji" placeholder="Gaji"><br>
        <input type="date" name="tanggal_mulai"><br>
        <input type="date" name="tanggal_selesai"><br>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br>
        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('lowongan') }}">{{ __('Daftar Lowongan') }}</a>
@endsection
