<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DB;

use App\Core\Domain\Model\Lowongan;

class TestController extends Controller
{
    /**
     * Show test page
     */
    public function test() {
        // Test DB connection
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }

        $lowongan = new Lowongan(1,
            2,
            3,
            'IF000001',
            2000000,
            new DateTime("2022-03-20 07:00:00"),
            new DateTime("2022-03-21 07:00:00"),
            "Test Deskripsi",
            true,
            NULL);
        return view('test.test', ['lowongan' => $lowongan]);
    }
}
