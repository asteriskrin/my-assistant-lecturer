{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Lowongan')
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
    @if (auth()->check() && auth()->user()->nip)
    <a href="{{ route('tambah-lowongan') }}" class="btn btn-primary mt-3">{{ __('Tambah Lowongan') }}</a>
    @endif
    @foreach($daftar_lowongan as $dl)
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $dl->mata_kuliah_nama }} {{ $dl->kode_kelas }}</h5>
                <p>{{ __('Gaji') }}: Rp{{ $dl->gaji }}</p>
                <p>{{ $dl->deskripsi }}</p>
                @if (auth()->check() && auth()->user()->id == $dl->dosen_id)
                <a href="{{ route('ubah-lowongan', ['lowonganId' => $dl->id]) }}" class="btn btn-primary    ">{{ __('Ubah') }}</a>
                <form method="POST" action="{{ route('hapus-lowongan', ['lowonganId' => $dl->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                @endif
                @if (auth()->check() && auth()->user()->nim)
                <form method="POST" action="{{ route('lamar', ['lowonganId' => $dl->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Lamar</button>
                </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
