<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;
use App\Core\Domain\Repository\LowonganRepository;
use App\Infrastructure\Query\SqlDaftarLowonganQuery;
use App\Infrastructure\Repository\SqlServerLowonganRepository;

class DependencyServiceProvider extends ServiceProvider {
    public function register() {
        // Query
        $this->app->bind(DaftarLowonganQueryInterface::class, SqlDaftarLowonganQuery::class);

        // Repository
        $this->app->bind(LowonganRepository::class, SqlServerLowonganRepository::class);
    }
}