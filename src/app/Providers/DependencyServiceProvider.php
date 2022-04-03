<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Application\Query\DaftarLowongan\DaftarLowonganQueryInterface;
use App\Infrastructure\Query\SqlDaftarLowonganQuery;

class DependencyServiceProvider extends ServiceProvider {
    public function register() {
        // Query
        $this->app->bind(DaftarLowonganQueryInterface::class, SqlDaftarLowonganQuery::class);
    }
}