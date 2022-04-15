<?php

namespace App\Core\Application\Service\HapusLowongan;

use App\Core\Domain\Model\Lowongan;
use App\Core\Domain\Model\LowonganId;
use App\Core\Domain\Repository\LowonganRepository;
use DateTime;
use InvalidArgumentException;

class HapusLowonganService {
    public function __construct(
        private LowonganRepository $lowonganRepository
    ) { }

    public function execute(HapusLowonganRequest $request) : void {
        $lowongan = $this->lowonganRepository->byId(new LowonganId($request->lowonganId));

        if (!$lowongan) {
            throw new InvalidArgumentException("lowongan_tidak_ditemukan");
        }

        $this->lowonganRepository->delete($lowongan);
    }
}