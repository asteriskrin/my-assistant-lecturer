<?php

namespace App\Core\Application\Service\UbahLowongan;

use App\Core\Domain\Model\DosenId;
use App\Core\Domain\Model\Lowongan;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\MataKuliahId;
use App\Core\Domain\Repository\LowonganRepository;
use DateTime;

class UbahLowonganService {
    public function __construct(
        private LowonganRepository $lowonganRepository
    ) { }

    public function execute(UbahLowonganRequest $request) : void {
        // TODO: Add dependency check here (dependency check to dosenId and mataKuliahId object if they exist or not)

        $lowonganId = new LowonganId($request->id);
        $dosenId = new DosenId($request->dosenId);
        $mataKuliahId = new MataKuliahId($request->mataKuliahId);

        $lowongan = new Lowongan(
            $lowonganId,
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

        $this->lowonganRepository->update($lowongan);
    }
}