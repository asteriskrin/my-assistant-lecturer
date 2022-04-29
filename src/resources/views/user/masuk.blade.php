@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
  <div class="container d-flex flex-column vh-100 justify-content-center align-items-center">
    <div class="card w-50">
      <div class="card-body">
        <h5 class="card-title mb-4">Masuk</h5>
        <form action="/masuk" method="post">
          @csrf
          <!-- NIM atau NIP -->
          <div class="form-floating mb-3">
            <input type="text" name="nomorIdentitas" class="form-control" id="nomorIdentitas" placeholder="NIM atau NIP" required>
            <label for="nomorIdentitas">NIM atau NIP</label>
          </div>

          <!-- Password -->
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>

          <div class="row g-2">
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
