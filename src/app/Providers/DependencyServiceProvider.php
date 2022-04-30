<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;
use App\Core\Domain\Repository\DosenRepository;
use App\Core\Domain\Repository\LowonganRepository;
use App\Core\Domain\Repository\MahasiswaRepository;
use App\Infrastructure\Query\SqlDaftarLowonganQuery;
use App\Infrastructure\Repository\SqlServerDosenRepository;
use App\Infrastructure\Repository\SqlServerLowonganRepository;
use App\Infrastructure\Repository\SqlServerMahasiswaRepository;

class DependencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Query
        $this->app->bind(DaftarLowonganQueryInterface::class, SqlDaftarLowonganQuery::class);

        // Repository
        $this->app->bind(LowonganRepository::class, SqlServerLowonganRepository::class);
        $this->app->bind(DosenRepository::class, SqlServerDosenRepository::class);
        $this->app->bind(MahasiswaRepository::class, SqlServerMahasiswaRepository::class);
    }
}
