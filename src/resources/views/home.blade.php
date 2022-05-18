@extends('layouts.app')
@section('title', 'Home')

@section('head-extension')
  <style>
    .home {
        height: 100vh;
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url({{ url('/images/home_background.jpg') }});
        background-size: cover;
        background-position: center;
        text-shadow: 0 0.05rem 0.1rem rgba(0, 0, 0, 0.5);
        box-shadow: inset 0 0 5rem rgba(0, 0, 0, 0.5);
    }
    .cover-container {
      max-width: 60vw;
    }
  </style>
@endsection

@section('content')
<div class="home d-flex text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column text-center">
        <main class="my-auto">
            <h1>MyITS Informatics Assistant Lecturer</h1>
            <p class="lead">
              Selamat datang di MIAL! <br>
              Segera daftarkan dirimu dan jelajahi berbagai lowongan asisten dosen di Informatika ITS
            </p>
            <a href="/lowongan" class="btn btn-lg btn-secondary font-weight-bold border-white bg-white text-dark">
              Lihat Lowongan
            </a>
        </main>
        <footer class="mt-auto text-white-50">
            <p>&copy; Gas 3.5 | 2022 </p>
        </footer>
    </div>
</div>
@endsection