@extends('layouts.app')
@section('title', 'Daftar')
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
        <h5 class="card-title">Daftar</h5>
        <h6 class="card-subtitle mb-4 text-muted">sebagai Dosen</h6>
        <form action="/daftar" method="post">
          @csrf
          <!-- Nama Lengkap -->
          <div class="form-floating">
            <input type="text" name="namaLengkap" class="form-control @error('namaLengkap') is-invalid @enderror" id="namaLengkap" placeholder="Nama Lengkap" required value="{{ old('namaLengkap') }}">
            <label for="namaLengkap">Nama Lengkap</label>
          </div>
          @error('namaLengkap')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
          @enderror

          <!-- NIP -->
          <div class="form-floating mt-3">
            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="NIP" required value="{{ old('nip') }}">
            <label for="nip">NIP</label>
          </div>
          @error('nip')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
          @enderror

          <!-- Nomor Telepon -->
          <div class="form-floating mt-3">
            <input type="text" name="nomorTelepon" class="form-control @error('nomorTelepon') is-invalid @enderror" id="nomorTelepon" placeholder="Nomor Telepon" required value="{{ old('nomorTelepon') }}">
            <label for="nomorTelepon">Nomor Telepon</label>
          </div>
          @error('nomorTelepon')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
          @enderror

          <!-- Email -->
          <div class="form-floating mt-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" required value="{{ old('email') }}">
            <label for="email">Email</label>
          </div>
          @error('email')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
          @enderror

          <!-- Password -->
          <div class="form-floating mt-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>
          @error('password')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
          @enderror

          <div class="row mt-3">
            <div class="col-md d-flex align-items-center justify-content-md-start justify-content-center">
              <!-- Masuk -->
              <a href="/masuk" class="link-primary text-decoration-none">Masuk</a>
            </div>
            <div class="col-md d-flex justify-content-md-end justify-content-center">
              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection