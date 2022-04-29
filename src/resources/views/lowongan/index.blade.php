{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Lowongan')
@section('content')
    @if(session('success'))
        {{ ucfirst(str_replace('_', ' ', session('success'))) . '.' }}
    @endif
    <ol>
    @foreach($daftar_lowongan as $dl)
        <li>
            Kode Kelas: {{ $dl->kode_kelas }} - Gaji: Rp{{ $dl->gaji }} - Deskripsi: {{ $dl->deskripsi }} - <a href="{{ route('ubah-lowongan', ['lowonganId' => $dl->id]) }}">{{ __('Ubah') }}</a>
            <form method="POST" action="{{ route('hapus-lowongan', ['lowonganId' => $dl->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
    </ol>
    <a href="{{ route('tambah-lowongan') }}">{{ __('Tambah Lowongan') }}</a>
@endsection