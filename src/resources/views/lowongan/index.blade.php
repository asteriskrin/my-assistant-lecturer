{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Lowongan')
@section('content')
    @if(session('success'))
        {{ ucfirst(str_replace('_', ' ', session('success'))) . '.' }}
    @endif
    <ol>
    @foreach($daftar_lowongan as $dl)
        <li>Kode Kelas: {{ $dl->kode_kelas }} - Gaji: Rp{{ $dl->gaji }} - Deskripsi: {{ $dl->deskripsi }}</li>
    @endforeach
    </ol>
    <a href="{{ route('tambah-lowongan') }}">{{ __('Tambah Lowongan') }}</a>
@endsection
