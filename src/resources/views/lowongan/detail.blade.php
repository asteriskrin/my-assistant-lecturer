{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Detail Lowongan')
@section('content')
<div class="container mt-3">
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

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2>Detail Lowongan</h2>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <span class="badge rounded-pill bg-secondary">{{ $mataKuliah->getKode() }}</span>
                    {{ $mataKuliah->getNama() }} {{ $lowongan->getKodeKelas() }}
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge rounded-pill bg-{{ $lowongan->getTerbuka() ? 'primary' : 'danger' }}">{{ $lowongan->getTerbuka() ? 'Terbuka' : 'Tutup' }}</span>
                        <span class="badge rounded-pill bg-success">Rp{{ $lowongan->getGaji() }}</span>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">Diajar oleh {{ $dosen->getNamaLengkap() }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Mulai {{ $lowongan->getTanggalMulai()->format('d M Y') }} sampai {{ $lowongan->getTanggalSelesai()->format('d M Y') }}</h6>
                    <p class="card-text">
                        {{ $lowongan->getDeskripsi() }}
                    </p>
                </div>
                <div class="card-footer">
                    @if($lowongan->getTerbuka() && auth()->check())
                        @if(auth()->user()->id == $lowongan->getDosenId()->id())
                            <form method="POST" action="{{ route('tutup-lowongan', ['lowonganId' => $lowongan->getId()->id()]) }}">
                                @csrf
                                <button type="submit" class="btn badge bg-danger"><i class="bi bi-x-circle"></i> Tutup Lowongan</button>
                            </form>
                        @endif
                        @if (auth()->user()->nim)
                            <form method="POST" class="d-inline" action="{{ route('lamar', ['lowonganId' => $lowongan->getId()->id()]) }}">
                                @csrf
                                <button type="submit" class="btn badge bg-success"><i class="bi bi-plus-circle"></i> Lamar</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <h2>Daftar Pelamar</h2>
                </div>
            </div>

            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">{{ __('No.') }}</th>
                        <th scope="col">{{ __('Tanggal') }}</th>
                        <th scope="col">{{ __('Nama') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Status Pembayaran') }}</th>
                        @if (auth()->check() && auth()->user()->id == $lowongan->getDosenId()->id())
                            <th scope="col">{{ __('Aksi') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftar_pelamar as $dp)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $dp->tanggal_melamar }}</td>
                        <td>{{ $dp->nama_lengkap }}</td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $dp->diterima ? 'success' : ($lowongan->getTerbuka() ? 'warning' : 'danger') }}">
                                {{ $dp->diterima ? 'Diterima' : ($lowongan->getTerbuka() ? 'Pending' : 'Tidak diterima') }}
                            </span>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $dp->dibayar ? 'success' : 'danger' }}">
                                {{ $dp->dibayar ? 'Lunas' : 'Belum lunas' }}
                            </span>
                        </td>
                        @if (auth()->check() && auth()->user()->id == $lowongan->getDosenId()->id())
                            <td>
                                <a href="{{ route('ubah-status-pelamar', ['lowonganId' => $lowongan->getId()->id(), 'mahasiswaId' => $dp->user_id]) }}" class="badge bg-warning" onclick="ubah({{ $loop->index }})"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('detail-mahasiswa', ['mahasiswaId' => $dp->user_id]) }}" class="badge bg-info"><i class="bi bi-eye"></i></a>
                            </td>
                        @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
