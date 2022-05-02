<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Application\Query\DaftarMataKuliah\DaftarMataKuliahQueryInterface;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;
use App\Core\Application\Query\DaftarLamaran\DaftarLamaranQueryInterface;
use App\Core\Application\Query\DaftarPelamar\DaftarPelamarQueryInterface;
use App\Core\Domain\Repository\DosenRepository;
use App\Core\Domain\Repository\LowonganRepository;
use App\Core\Domain\Repository\MahasiswaRepository;
use App\Core\Domain\Repository\AsistenDosenRepository;
use App\Core\Domain\Repository\MataKuliahRepository;
use App\Infrastructure\Query\SqlDaftarLowonganQuery;
use App\Infrastructure\Query\SqlDaftarMataKuliahQuery;
use App\Infrastructure\Query\SqlDaftarLamaranQuery;
use App\Infrastructure\Query\SqlDaftarPelamarQuery;
use App\Infrastructure\Repository\SqlServerDosenRepository;
use App\Infrastructure\Repository\SqlServerLowonganRepository;
use App\Infrastructure\Repository\SqlServerMahasiswaRepository;
use App\Infrastructure\Repository\SqlServerAsistenDosenRepository;
use App\Infrastructure\Repository\SqlServerMataKuliahRepository;

class DependencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Query
        $this->app->bind(DaftarLowonganQueryInterface::class, SqlDaftarLowonganQuery::class);
        $this->app->bind(DaftarMataKuliahQueryInterface::class, SqlDaftarMataKuliahQuery::class);
        $this->app->bind(DaftarLamaranQueryInterface::class, SqlDaftarLamaranQuery::class);
        $this->app->bind(DaftarPelamarQueryInterface::class, SqlDaftarPelamarQuery::class);

        // Repository
        $this->app->bind(LowonganRepository::class, SqlServerLowonganRepository::class);
        $this->app->bind(DosenRepository::class, SqlServerDosenRepository::class);
        $this->app->bind(MahasiswaRepository::class, SqlServerMahasiswaRepository::class);
        $this->app->bind(AsistenDosenRepository::class, SqlServerAsistenDosenRepository::class);
        $this->app->bind(MataKuliahRepository::class, SqlServerMataKuliahRepository::class);
    }
}
