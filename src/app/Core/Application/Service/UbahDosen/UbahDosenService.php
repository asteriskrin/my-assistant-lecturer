<?php

namespace App\Core\Application\Service\UbahDosen;

use App\Core\Domain\Exception\ApplicationServiceException;
use App\Core\Domain\Model\Dosen;
use App\Core\Domain\Model\DosenId;
use App\Core\Domain\Repository\DosenRepository;
use DateTime;

class UbahDosenService
{
    public function __construct(
        private DosenRepository $dosenRepository
    ) {
    }

    public function execute(UbahDosenRequest $request): void
    {
        $dosen = new Dosen(
            new DosenId($request->id),
            $request->namaLengkap,
            $request->nip,
            $request->nomorTelepon,
            $request->email,
            $request->password,
            new DateTime()
        );

        if (!$this->dosenRepository->update($dosen)) {
            throw new ApplicationServiceException('update data dosen gagal');
        }
    }
}
