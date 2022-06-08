<?php

namespace App\Core\Application\Service\BuatNotifikasi;

use App\Core\Domain\Model\Notifikasi;
use App\Core\Domain\Model\NotifikasiId;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Repository\NotifikasiRepository;
use DateTime;

class BuatNotifikasiService {
    public function __construct(
        private NotifikasiRepository $notifikasiRepository
    ) { }

    public function execute(BuatNotifikasiRequest $request) : void {

        $notifikasiId = NotifikasiId::make();
        $mahasiswaId = new MahasiswaId($request->mahasiswaId);
        
        $notifikasi = new Notifikasi(
            NotifikasiId::make(),
            $mahasiswaId,
            $request->jenis,
            $request->pesan,
            false,
            new DateTime()
        );

        $this->notifikasiRepository->insert($notifikasi);
    }
}