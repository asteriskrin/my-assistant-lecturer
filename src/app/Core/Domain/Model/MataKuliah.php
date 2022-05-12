<?php

namespace App\Core\Domain\Model;

use DateTime;
use App\Core\Domain\Model\MataKuliahId;

class MataKuliah {
    public function __construct(
        private MataKuliahId $id,
        private string $nama,
        private int $semester,
        private string $kode
    ) { }

    public function getId(): MataKuliahId { return $this->id; }
    public function getNama(): string { return $this->nama; }
    public function getSemester(): int { return $this->semester; }
    public function getKode(): string { return $this->kode; }
}
