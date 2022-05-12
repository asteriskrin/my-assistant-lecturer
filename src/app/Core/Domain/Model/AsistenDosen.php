<?php

namespace App\Core\Domain\Model;

use DateTime;
use App\Core\Domain\Model\MahasiswaId;
use App\Core\Domain\Model\LowonganId;

class AsistenDosen
{
    private MahasiswaId $mahasiswa_id;
    private LowonganId $lowongan_id;
    private bool $diterima;
    private bool $dibayar;
    private DateTime $created_at;

    public function __construct(
        MahasiswaId $mahasiswa_id,
        LowonganId $lowongan_id,
        bool $diterima,
        bool $dibayar,
        ?DateTime $created_at
    ) {
        $this->mahasiswa_id = $mahasiswa_id;
        $this->lowongan_id = $lowongan_id;
        $this->diterima = $diterima;
        $this->dibayar = $dibayar;
        $this->created_at = $created_at;
    }

    public function getMahasiswaId(): MahasiswaId { return $this->mahasiswa_id; }
    public function getLowonganId(): LowonganId { return $this->lowongan_id; }
    public function getDiterima(): bool { return $this->diterima; }
    public function getDibayar(): bool { return $this->dibayar; }
    public function getCreatedAt(): DateTime { return $this->created_at; }
    public function setDiterima(bool $diterima): void { $this->diterima = $diterima; }
    public function setDibayar(bool $dibayar): void { $this->dibayar = $dibayar; }
}
