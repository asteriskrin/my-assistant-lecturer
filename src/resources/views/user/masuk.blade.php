@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
  <div class="container d-flex flex-column vh-100 justify-content-center align-items-center">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show d-block w-50" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show d-block w-50" role="alert">
          {{ session('failed') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card w-50">
      <div class="card-body">
        <h5 class="card-title mb-4">Masuk</h5>
        <form action="/masuk" method="post">
          @csrf
          <!-- Masuk sebagai -->
          <div class="form-floating">
            <select name="masukSebagai" class="form-select" id="masukSebagai" aria-label="Sebagai">
              <option value="dosen" selected>Dosen</option>
              <option value="mahasiswa">Mahasiswa</option>
            </select>
            <label for="masukSebagai">Sebagai</label>
          </div>

          <!-- NIM atau NIP -->
          <div class="form-floating mt-3">
            <input type="text" name="nomorIdentitas" class="form-control @error('nomorIdentitas') is-invalid @enderror" id="nomorIdentitas" placeholder="NIM atau NIP" required value="{{ old('nomorIdentitas') }}">
            <label for="nomorIdentitas">NIM atau NIP</label>
          </div>
          @error('nomorIdentitas')
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
              <!-- Daftar -->
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="daftarDropdown"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Daftar Akun
                </button>
                <ul class="dropdown-menu" aria-labelledby="daftarDropdown">
                  <li><a class="dropdown-item" href="/daftar?peran=dosen">Dosen</a></li>
                  <li><a class="dropdown-item" href="/daftar?peran=mahasiswa">Mahasiswa</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md d-flex justify-content-md-end justify-content-center">
              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
