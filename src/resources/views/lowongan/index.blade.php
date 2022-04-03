{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Lowongan')
@section('content')
    <ol>
    @foreach($daftar_lowongan as $dl)
        <li>Kode Kelas: {{ $dl->kode_kelas }} - Gaji: Rp{{ $dl->gaji }} - Deskripsi: {{ $dl->deskripsi }}</li>
    @endforeach
    </ol>
@endsection
