<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
      </ul>
      <div class="ul navbar-nav ms-auto">
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
      </div>
    </div>
  </div>
</nav>