<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">MIAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('lowongan') ? 'active' : '' }}" href="/lowongan">Lowongan</a>
        </li>
        @auth
        @if (auth()->user()->nim)
        <li class="nav-item">
          <a class="nav-link {{ Request::route()->getName() == 'lamaran' ? 'active' : '' }}" href="{{ route('lamaran') }}">{{ __('Lamaranku') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::route()->getName() == 'notifikasi' ? 'active' : '' }}" href="{{ route('notifikasi') }}">{{ __('Notifikasi') }}</a>
        </li>
        @elseif (auth()->user()->nip)
        <li class="nav-item">
          <a class="nav-link {{ Request::route()->getName() == 'lowonganku' ? 'active' : '' }}" href="{{ route('lowonganku') }}">{{ __('Lowonganku') }}</a>
        </li>
        @endif
        @endauth
      </ul>
      <div class="ul navbar-nav ms-auto">
        {{-- If authenticated --}}
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Selamat datang, {{ auth()->user()->nama_lengkap }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/ubah-profil">Ubah Profil</a></li>
            <li><a class="dropdown-item" href="/lowongan">Lowongan</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>  
              <form action="/keluar" method="post">
                @csrf
                <button type="submit" class="dropdown-item">Keluar</button>
              </form>
            </li>
          </ul>
        </li>
        {{-- Else not authenticated --}}
        @else
        <li class="nav-item">
          <a class="nav-link {{ Request::is('masuk') ? 'active' : '' }}" href="/masuk">Masuk</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ Request::is('daftar*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Daftar
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/daftar?peran=dosen">Dosen</a></li>
            <li><a class="dropdown-item" href="/daftar?peran=mahasiswa">Mahasiswa</a></li>
          </ul>
        </li>
        @endauth
      </div>
    </div>
  </div>
</nav>