<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Core\Application\Service\BuatNotifikasi\BuatNotifikasiRequest;
use App\Core\Application\Service\BuatNotifikasi\BuatNotifikasiService;

class BuatNotifikasiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $dibaca;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $mahasiswa_id,
        private string $jenis,
        private string $pesan
    )
    {
        $this->dibaca = "N";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(BuatNotifikasiService $buatNotifikasiService)
    {
        $buatNotifikasiRequest = new BuatNotifikasiRequest($this->mahasiswa_id, $this->jenis, $this->pesan);
        try {
            $buatNotifikasiService->execute($buatNotifikasiRequest);
        }
        catch (Exception $e) {
            // Do something
        }
    }
}
