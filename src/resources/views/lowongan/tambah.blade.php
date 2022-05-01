@extends('layouts.app')
@section('title', 'Tambah Lowongan')
@section('content')
<div class="container d-flex flex-column vh-100 justify-content-center align-items-center">
    @if(session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show d-block w-50" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card w-50">
        <div class="card-body">
            <h5 class="card-title">Tambah Lowongan</h5>
            <form action="{{ route('tambah-lowongan') }}" method="POST" class="mt-3">
                @csrf
                <!-- Mata Kuliah -->
                <div class="form-floating">
                    <select class="form-select" aria-label="{{ __('Mata Kuliah') }}" name="mata_kuliah_id" id="mata_kuliah_id">
                        @foreach($daftar_mata_kuliah as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->nama }}</option>
                        @endforeach
                    </select>
                    <label for="mata_kuliah_id">Mata Kuliah</label>
                </div>
                <!-- Kode Kelas -->
                <div class="form-floating mt-3">
                    <input type="text" name="kode_kelas" class="form-control @error('kode_kelas') is-invalid @enderror" id="kode_kelas" placeholder="Kode Kelas" required value="{{ old('kode_kelas') }}">
                    <label for="kode_kelas">Kode Kelas</label>
                </div>
                @error('kode_kelas')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
                <!-- Gaji -->
                <div class="form-floating mt-3">
                    <input type="text" name="gaji" class="form-control @error('gaji') is-invalid @enderror" id="gaji" placeholder="Gaji" required value="{{ old('gaji') }}">
                    <label for="gaji">Gaji</label>
                </div>
                @error('gaji')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
                <!-- Tanggal Mulai -->
                <div class="form-floating mt-3">
                    <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" required value="{{ old('tanggal_mulai') }}">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                </div>
                @error('tanggal_mulai')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
                <!-- Tanggal Selesai -->
                <div class="form-floating mt-3">
                    <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" required value="{{ old('tanggal_selesai') }}">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                </div>
                @error('tanggal_selesai')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
                <!-- Deskripsi -->
                <div class="form-floating mt-3">
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Deskripsi" required>{{ old('deskripsi') }}</textarea>
                    <label for="deskripsi">Deskripsi</label>
                </div>
                @error('deskripsi')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </form>
        </div>
    </div>
</div>
<a href="{{ route('lowongan') }}">{{ __('Daftar Lowongan') }}</a>
@endsection
