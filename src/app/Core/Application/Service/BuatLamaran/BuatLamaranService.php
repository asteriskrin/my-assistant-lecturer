<?php

namespace App\Core\Application\Service\BuatLamaran;

use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Model\AsistenDosen;
use App\Core\Domain\Repository\LowonganRepository;
use App\Core\Domain\Repository\AsistenDosenRepository;
use DateTime;

class BuatLamaranService {
    public function __construct(
        private LowonganRepository $lowonganRepository,
        private AsistenDosenRepository $asistenDosenRepository
    ) { }

    public function execute(BuatLamaranRequest $request) : void {
        // TODO: Add dependency check here (dependency check to lowonganId and mahasiswaId object if they exist or not)

        $lowonganId = new LowonganId($request->lowonganId);
        $mahasiswaId = new MahasiswaId($request->mahasiswaId);

        $asistenDosen = new AsistenDosen(
            $mahasiswaId,
            $lowonganId,
            false,
            false,
            new DateTime()
        );

        $this->asistenDosenRepository->insert($asistenDosen);
    }
}