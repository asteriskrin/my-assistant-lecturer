<?php

namespace App\Core\Application\Service\TutupLowongan;

use App\Core\Domain\Model\Lowongan;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Repository\LowonganRepository;
use DateTime;
use InvalidArgumentException;

class TutupLowonganService {
    public function __construct(
        private LowonganRepository $lowonganRepository
    ) { }

    public function execute(TutupLowonganRequest $request) : void {
        $lowongan = $this->lowonganRepository->byId(new LowonganId($request->lowonganId));

        if (!$lowongan) {
            throw new InvalidArgumentException("lowongan_tidak_ditemukan");
        }

        $lowongan->setTerbuka(false);

        $this->lowonganRepository->update($lowongan);
    }
}