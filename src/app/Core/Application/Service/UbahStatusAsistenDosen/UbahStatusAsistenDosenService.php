<?php

namespace App\Core\Application\Service\UbahStatusAsistenDosen;

use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Repository\AsistenDosenRepository;
use App\Core\Domain\Repository\LowonganRepository;
use App\Core\Domain\Exception\ApplicationServiceException;
use DateTime;

class UbahStatusAsistenDosenService {
    public function __construct(
        private AsistenDosenRepository $asistenDosenRepository,
        private LowonganRepository $lowonganRepository
    ) { }

    public function execute(UbahStatusAsistenDosenRequest $request) : void {
        $lowonganId = new LowonganId($request->lowongan_id);
        $mahasiswaId = new MahasiswaId($request->mahasiswa_id);
        $diterima = $request->diterima;
        $dibayar = $request->dibayar;

        $lowongan = $this->lowonganRepository->byId($lowonganId);
        if (!$lowongan)
            throw new ApplicationServiceException("Lowongan tidak ditemukan.");
        $asistenDosen = $this->asistenDosenRepository->byId($lowonganId, $mahasiswaId);
        if (!$asistenDosen)
            throw new ApplicationServiceException("Lamaran tidak ditemukan.");
        $asistenDosen->setDiterima($diterima);
        $asistenDosen->setDibayar($dibayar);
        $this->asistenDosenRepository->update($asistenDosen);
    }
}