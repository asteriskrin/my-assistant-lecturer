<?php

namespace App\Core\Domain\Model;

use DateTime;
use App\Core\Domain\Model\NotifikasiId;
use App\Core\Domain\Model\MahasiswaiId;

class Notifikasi {
    private NotifikasiId $id;
    private MahasiswaId $mahasiswa_id;
    private string $jenis;
    private string $pesan;
    private bool $dibaca;
    private DateTime $created_at;

    public function __construct(
        NotifikasiId $id,
        MahasiswaId $mahasiswa_id,
        string $jenis,
        string $pesan,
        Bool $dibaca,
        ?DateTime $created_at
    ) {
        if ($jenis == '\0') throw new \InvalidArgumentException("deskripsi can not be null string.");
        if ($pesan == '\0') throw new \InvalidArgumentException("deskripsi can not be null string.");
        if ($created_at == NULL) $created_at = new DateTime;
        $this->id = $id;
        $this->mahasiswa_id = $mahasiswa_id;
        $this->jenis = $jenis;
        $this->pesan = $pesan;
        $this->terbuka = $terbuka;
        $this->created_at = $created_at;
    }

    public function getId() : NotifikasiId {
        return $this->id;
    }

    public function getMahasiswaId() : MahasiswaiId {
        return $this->mahasiswa_id;
    }

    public function getJenis() : string {
        return $this->jenis;
    }
  
    public function getPesan() : string {
        return $this->pesan;
    }
  
    public function getDibaca() : string {
        return $this->dibaca;
    }
  
    public function سetDibaca() : string {
        $this->dibaca = $dibaca;
    }
  
    public function getCreatedAt() : DateTime {
        return $this->created_at;
    }
}