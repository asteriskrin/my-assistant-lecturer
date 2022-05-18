{{-- This is slave template --}}
@extends('layouts.app')
@section('title', 'Daftar Lamaran')
@section('content')
<div class="container d-flex flex-column vh-100 justify-content-center align-items-center">
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

    <div class="card w-25">
      <div class="card-body">
        <h5 class="card-title">Ubah Status Pelamar</h5>
        <h6 class="card-subtitle mb-3 text-muted">{{ $mahasiswa->getNamaLengkap() }}</h6>
        <form method="POST" action="{{ route('ubah-status-pelamar', ['lowonganId' => $asistenDosen->getLowonganId()->id(), 'mahasiswaId' => $mahasiswa->getId()->id()]) }}">
            @csrf
            <label>Status Penerimaan</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="diterima" id="ubah-diterima" value="1" @if ($asistenDosen->getDiterima()) checked @endif>
                <label class="form-check-label" for="ubah-diterima">
                    Diterima
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="diterima" id="ubah-tidak-diterima" value="0" @if (!$asistenDosen->getDiterima()) checked @endif>
                <label class="form-check-label" for="ubah-tidak-diterima">
                    Tidak diterima
                </label>
            </div>
            <label class="mt-3">Status Honor</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dibayar" id="ubah-dibayar" value="1" @if ($asistenDosen->getDibayar()) checked @endif>
                <label class="form-check-label" for="ubah-dibayar">
                    Sudah dibayar
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dibayar" id="ubah-belum-dibayar" value="0" @if (!$asistenDosen->getDibayar()) checked @endif>
                <label class="form-check-label" for="ubah-belum-dibayar">
                    Belum dibayar
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">{{ __('Save') }}</button>
        </form>
      </div>
    </div>
</div>
@endsection
