{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Lowongan')
@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <h2>Lowongan</h2>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-block mt-3 mb-0" role="alert">
            {{ ucfirst(str_replace('_', ' ', session('success'))) . '.' }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('failed'))
        <div class="alert alert-danger alert-dismissible fade show d-block mt-3 mb-0" role="alert">
            {{ ucfirst(str_replace('_', ' ', session('failed'))) . '.' }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (auth()->check() && auth()->user()->nip)
    <a href="{{ route('tambah-lowongan') }}" class="btn btn-primary mt-3">{{ __('Tambah Lowongan') }}</a>
    @endif

    <div class="row mt-3">
        @foreach($daftar_lowongan as $dl)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header">
                        {{ $dl->mata_kuliah_nama }} {{ $dl->kode_kelas }}
                    </div>
                    <div class="card-body">
                        <span class="badge rounded-pill bg-success">Rp{{ $dl->gaji }}</span>
                        <p class="card-text">{{ $dl->deskripsi }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('detail-lowongan', ['lowonganId' => $dl->id]) }}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                        @if (auth()->check() && auth()->user()->id == $dl->dosen_id)
                            <a href="{{ route('ubah-lowongan', ['lowonganId' => $dl->id]) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <form method="POST" class="d-inline" action="{{ route('hapus-lowongan', ['lowonganId' => $dl->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                            </form>
                        @endif
                        @if (auth()->check() && auth()->user()->nim)
                            <form method="POST" class="d-inline" action="{{ route('lamar', ['lowonganId' => $dl->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
