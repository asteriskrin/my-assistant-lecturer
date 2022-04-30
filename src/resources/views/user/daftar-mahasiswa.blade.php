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
        <h6 class="card-subtitle mb-4 text-muted">sebagai Mahasiswa</h6>
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

          <!-- NIM -->
          <div class="form-floating mt-3">
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" id="nim" placeholder="NIM" required value="{{ old('nim') }}">
            <label for="nim">NIM</label>
          </div>
          @error('nim')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
          @enderror

          <!-- URL Transkrip Mata Kuliah -->
          <div class="form-floating mt-3">
            <input type="url" name="urlTranskripMk" class="form-control @error('urlTranskripMk') is-invalid @enderror" id="urlTranskripMk" placeholder="URL Transkrip Mata Kuliah" required value="{{ old('urlTranskripMk') }}">
            <label for="urlTranskripMk">URL Transkrip Mata Kuliah</label>
          </div>
          @error('urlTranskripMk')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
          @enderror

          <div class="row mt-3">
            <div class="col-md">
              <!-- IPK -->
              <div class="form-floating">
                <input type="number" name="ipk" step="0.01" min="0" max="4" class="form-control @error('ipk') is-invalid @enderror" id="ipk" placeholder="IPK"
                  required value="{{ old('ipk') }}">
                <label for="ipk">IPK</label>
              </div>
              @error('ipk')
                <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-md">
              <!-- Semester -->
              <div class="form-floating">
                <input type="number" name="semester" min="1" max="14" class="form-control @error('semester') is-invalid @enderror" id="semester" placeholder="Semester"
                  required value="{{ old('semester') }}">
                <label for="semester">Semester</label>
              </div>
              @error('semester')
                <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md">
              <!-- Nomor Rekening -->
              <div class="form-floating">
                <input type="text" name="nomorRekening" class="form-control @error('nomorRekening') is-invalid @enderror" id="nomorRekening" placeholder="Nomor Rekening" required value="{{ old('nomorRekening') }}">
                <label for="nomorRekening">Nomor Rekening</label>
              </div>
              @error('nomorRekening')
                <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-md">
              <!-- Nomor Telepon -->
              <div class="form-floating">
                <input type="text" name="nomorTelepon" class="form-control @error('nomorTelepon') is-invalid @enderror" id="nomorTelepon" placeholder="Nomor Telepon" required value="{{ old('nomorTelepon') }}">
                <label for="nomorTelepon">Nomor Telepon</label>
              </div>
              @error('nomorTelepon')
                <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

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