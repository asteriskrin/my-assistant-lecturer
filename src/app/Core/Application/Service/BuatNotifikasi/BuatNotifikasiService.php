<?php

namespace App\Core\Application\Service\BuatNotifikasi;

use App\Core\Domain\Model\Notifikasi;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Repository\NotifikasiRepository;
use DateTime;

class BuatNotifikasiService {
    public function __construct(
        private NotifikasiRepository $notifikasiRepository
    ) { }

    public function execute(BuatNotifikasiRequest $request) : void {
        // TODO: Add dependency check here (dependency check to dosenId and mataKuliahId object if they exist or not)

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

        $this->NotifikasiRepository->save($notifikasi);
    }
}