{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Lamaran')
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
    @foreach($daftar_lamaran as $dl)
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $dl->mata_kuliah_nama }} {{ $dl->kode_kelas }}</h5>
                <p>{{ __('Gaji') }}: Rp{{ $dl->gaji }}</p>
                <p>{{ __('Dilamar pada') }} {{ $dl->lamaran_created_at }}</p>
                <p>{{ __('Status') }}: {{ $dl->lamaran_diterima ? 'Diterima' : 'Pending' }}</p>
                <p>{{ __('Status Gaji') }}: {{ $dl->lamaran_dibayar ? 'Dibayar' : 'Pending' }}</p>
                <p>{{ $dl->deskripsi }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
