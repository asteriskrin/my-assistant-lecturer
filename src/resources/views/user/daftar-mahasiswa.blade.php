@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
  <div class="container d-flex flex-column vh-100 justify-content-center align-items-center">
    <div class="card w-50">
      <div class="card-body">
        <h5 class="card-title">Daftar</h5>
        <h6 class="card-subtitle mb-4 text-muted">sebagai Mahasiswa</h6>
        <form action="/daftar" method="post">
          @csrf
          <!-- Nama Lengkap -->
          <div class="form-floating mb-3">
            <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" required>
            <label for="namaLengkap">Nama Lengkap</label>
          </div>

          <!-- NIM -->
          <div class="form-floating mb-3">
            <input type="text" name="nim" class="form-control" id="nim" placeholder="NIM" required>
            <label for="nim">NIM</label>
          </div>

          <!-- URL Transkrip Mata Kuliah -->
          <div class="form-floating mb-3">
            <input type="url" name="urlTranskripMk" class="form-control" id="urlTranskripMk" placeholder="URL Transkrip Mata Kuliah" required>
            <label for="urlTranskripMk">URL Transkrip Mata Kuliah</label>
          </div>

          <div class="row g-2">
            <div class="col-md">
              <!-- IPK -->
              <div class="form-floating mb-3">
                <input type="number" name="ipk" step="0.01" min="0" max="4" class="form-control" id="ipk" placeholder="IPK"
                  required>
                <label for="ipk">IPK</label>
              </div>
            </div>
            <div class="col-md">
              <!-- Semester -->
              <div class="form-floating mb-3">
                <input type="number" name="semester" min="1" max="14" class="form-control" id="semester" placeholder="Semester"
                  required>
                <label for="semester">Semester</label>
              </div>
            </div>
          </div>

          <div class="row g-2">
            <div class="col-md">
              <!-- Nomor Rekening -->
              <div class="form-floating mb-3">
                <input type="text" name="nomorRekening" class="form-control" id="nomorRekening" placeholder="Nomor Rekening" required>
                <label for="nomorRekening">Nomor Rekening</label>
              </div>
            </div>
            <div class="col-md">
              <!-- Nomor Telepon -->
              <div class="form-floating mb-3">
                <input type="text" name="nomorTelepon" class="form-control" id="nomorTelepon" placeholder="Nomor Telepon" required>
                <label for="nomorTelepon">Nomor Telepon</label>
              </div>
            </div>
          </div>

          <!-- Email -->
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
            <label for="email">Email</label>
          </div>

          <!-- Password -->
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>

          <div class="row g-2">
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