<?php

namespace App\Core\Application\Service\BuatLowongan;

use App\Core\Domain\Model\DosenId;
use App\Core\Domain\Model\Lowongan;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\MataKuliahId;
use App\Core\Domain\Repository\LowonganRepository;
use DateTime;

class BuatLowonganService {
    public function __construct(
        private LowonganRepository $lowonganRepository
    ) { }

    public function execute(BuatLowonganRequest $request) : void {
        // TODO: Add dependency check here (dependency check to dosenId and mataKuliahId object if they exist or not)

        $lowonganId = LowonganId::make();
        $dosenId = new DosenId($request->dosenId);
        $mataKuliahId = new MataKuliahId($request->mataKuliahId);

        $lowongan = new Lowongan(
            LowonganId::make(),
            $dosenId,
            $mataKuliahId,
            $request->kodeKelas,
            $request->gaji,
            new DateTime($request->tanggalMulai),
            new DateTime($request->tanggalSelesai),
            $request->deskripsi,
            true,
            new DateTime()
        );

        $this->lowonganRepository->save($lowongan);
    }
}