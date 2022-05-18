{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar LowonganKu')
@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <h2>Lowonganku</h2>
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
    @if (auth()->check() && auth()->user()->nip)
    <a href="{{ route('tambah-lowongan') }}" class="btn btn-primary mt-3">{{ __('Tambah Lowongan') }}</a>
    @endif



    <table class="table table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th scope="col">No. </th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Kode Kelas</th>
            <th scope="col">Gaji</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($daftar_lowongan as $dl)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $dl->mata_kuliah_nama }}</td>
                <td>{{ $dl->kode_kelas }}</td>
                <td>Rp{{ $dl->gaji }}</td>
                <td>
                    <a href="{{ route('detail-lowongan', ['lowonganId' => $dl->id]) }}" class="badge bg-info"><i class="bi bi-eye"></i></a>
                    @if (auth()->check() && auth()->user()->id == $dl->dosen_id)
                    <a href="{{ route('ubah-lowongan', ['lowonganId' => $dl->id]) }}" class="badge bg-warning"><i class="bi bi-pencil-square"></i></a>
                    <form method="POST" class="d-inline" action="{{ route('hapus-lowongan', ['lowonganId' => $dl->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn badge bg-danger"><i class="bi bi-x-circle"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>

    {{-- @foreach($daftar_lowongan as $dl)
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $dl->mata_kuliah_nama }} {{ $dl->kode_kelas }}</h5>
                <p>{{ __('Gaji') }}: Rp{{ $dl->gaji }}</p>
                <p>{{ $dl->deskripsi }}</p>

                <a href="{{ route('detail-lowongan', ['lowonganId' => $dl->id]) }}" class="btn btn-primary">{{ __('Lihat Detail') }}</a>
                @if (auth()->check() && auth()->user()->id == $dl->dosen_id)
                <a href="{{ route('ubah-lowongan', ['lowonganId' => $dl->id]) }}" class="btn btn-primary">{{ __('Ubah') }}</a>
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
    @endforeach --}}
</div>
@endsection
