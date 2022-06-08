<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Core\Application\Service\BuatNotifikasi\BuatNotifikasiRequest;
use App\Core\Application\Service\BuatNotifikasi\BuatNotifikasiService;

class CreateNotifikasi
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        private BuatNotifikasiService $buatNotifikasiService)
    { }

    /**
     * Handle event
     */
    public function handle($mahasiswa_id, $jenis, $pesan) {
        $buatNotifikasiRequest = new BuatNotifikasiRequest($mahasiswa_id, $jenis, $pesan);
        try {
            $this->buatNotifikasiService->execute($buatNotifikasiRequest);
        }
        catch (Exception $e) {
            // Do reporting
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
