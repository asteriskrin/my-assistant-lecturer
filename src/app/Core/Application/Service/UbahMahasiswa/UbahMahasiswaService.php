<?php

namespace App\Core\Application\Service\UbahMahasiswa;

use App\Core\Domain\Exception\ApplicationServiceException;
use App\Core\Domain\Model\Mahasiswa;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Repository\MahasiswaRepository;
use DateTime;

class UbahMahasiswaService
{
    public function __construct(
        private MahasiswaRepository $mahasiswaRepository
    ) {
    }

    public function execute(UbahMahasiswaRequest $request): void
    {
        $mahasiswa = new Mahasiswa(
            new MahasiswaId($request->id),
            $request->namaLengkap,
            $request->nim,
            $request->urlTranskripMk,
            $request->ipk,
            $request->semester,
            $request->nomorRekening,
            $request->nomorTelepon,
            $request->email,
            $request->password,
            new DateTime()
        );

        if (!$this->mahasiswaRepository->update($mahasiswa)) {
            throw new ApplicationServiceException('update data mahasiswa gagal');
        }
    }
}
