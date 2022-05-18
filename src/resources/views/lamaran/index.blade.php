{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Lamaran')
@section('content')
<div class="container">
    <div class="row mt-3 mx-0">
        <div class="card">
            <div class="card-body">
                <h2>Lamaranku</h2>
            </div>
        </div>
    </div>

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

    <table class="table table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th scope="col">No. </th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Kode Kelas</th>
            <th scope="col">Gaji</th>
            <th scope="col">Tanggal Lamar</th>
            <th scope="col">Status Pendaftaran</th>
            <th scope="col">Status Gaji</th>
        </tr>
    </thead>
    <tbody>
        @foreach($daftar_lamaran as $dl)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $dl->mata_kuliah_nama }}</td>
                <td>{{ $dl->kode_kelas }}</td>
                <td>Rp{{ $dl->gaji }}</td>
                <td>{{ $dl->lamaran_created_at }}</td>
                <td>
                    <span class="badge rounded-pill bg-{{ $dl->lamaran_diterima ? 'success' : 'warning' }}">
                        {{ $dl->lamaran_diterima ? 'Diterima' : 'Pending' }}
                    </span>
                </td>
                <td>
                    <span class="badge rounded-pill bg-{{ $dl->lamaran_dibayar ? 'success' : 'danger' }}">
                        {{ $dl->lamaran_dibayar ? 'Lunas' : 'Belum lunas' }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>

    {{-- @foreach($daftar_lamaran as $dl)
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
    @endforeach --}}
</div>
@endsection
