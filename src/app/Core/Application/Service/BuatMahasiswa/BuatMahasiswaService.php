<?php

namespace App\Core\Application\Service\BuatMahasiswa;

use App\Core\Domain\Exception\ApplicationServiceException;
use App\Core\Domain\Model\Mahasiswa;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Repository\MahasiswaRepository;
use DateTime;

class BuatMahasiswaService
{
    public function __construct(
        private MahasiswaRepository $mahasiswaRepository
    ) {
    }

    public function execute(BuatMahasiswaRequest $request): void
    {
        $mahasiswaId = MahasiswaId::make();

        $mahasiswa = new Mahasiswa(
            $mahasiswaId,
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

        if (!$this->mahasiswaRepository->insert($mahasiswa)) {
            throw new ApplicationServiceException('insert data mahasiswa gagal');
        }
    }
}
