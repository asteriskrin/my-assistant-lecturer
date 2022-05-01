<?php

namespace App\Core\Application\Service\BuatDosen;

use App\Core\Domain\Exception\ApplicationServiceException;
use App\Core\Domain\Model\Dosen;
use App\Core\Domain\Model\DosenId;
use App\Core\Domain\Repository\DosenRepository;
use DateTime;

class BuatDosenService
{
    public function __construct(
        private DosenRepository $dosenRepository
    ) {
    }

    public function execute(BuatDosenRequest $request): void
    {
        $dosenId = DosenId::make();

        $dosen = new Dosen(
            $dosenId,
            $request->namaLengkap,
            $request->nip,
            $request->nomorTelepon,
            $request->email,
            $request->password,
            new DateTime()
        );

        if (!$this->dosenRepository->insert($dosen)) {
            throw new ApplicationServiceException('insert data dosen gagal');
        }
    }
}
