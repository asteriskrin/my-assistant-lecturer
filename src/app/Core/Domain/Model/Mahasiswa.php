<?php

namespace App\Core\Domain\Model;

use DateTime;
use App\Core\Domain\Model\MahasiswaId;

class Mahasiswa
{
  private MahasiswaId $id;
  private string $nama_lengkap;
  private string $nim;
  private string $url_transkrip_mk;
  private float $ipk;
  private int $semester;
  private string $nomor_rekening;
  private string $nomor_telepon;
  private string $email;
  private string $password;
  private DateTime $created_at;

  public function __construct(
    MahasiswaId $id,
    string $nama_lengkap,
    string $nim,
    string $url_transkrip_mk,
    float $ipk,
    int $semester,
    string $nomor_rekening,
    string $nomor_telepon,
    string $email,
    string $password,
    ?DateTime $created_at
  ) {
    if ($nama_lengkap == '\0') throw new \InvalidArgumentException("nama_lengkap can not be null string.");
    if ($nim == '\0') throw new \InvalidArgumentException("nim can not be null string.");
    if ($url_transkrip_mk == '\0') throw new \InvalidArgumentException("url_transkrip_mk can not be null string.");
    if ($ipk < 0 || $ipk > 4) throw new \InvalidArgumentException("ipk can not be less than 0 or greater than 4");
    if ($semester < 1 || $semester > 14) throw new \InvalidArgumentException("semester can not be less than 1 or greater than 14");
    if ($nomor_rekening == '\0') throw new \InvalidArgumentException("nomor_rekening can not be null string.");
    if ($nomor_telepon == '\0') throw new \InvalidArgumentException("nomor_telepon can not be null string.");
    if ($email == '\0') throw new \InvalidArgumentException("email can not be null string.");
    if ($password == '\0') throw new \InvalidArgumentException("password can not be null string.");
    if ($created_at == NULL) $created_at = new DateTime;

    $this->id = $id;
    $this->nama_lengkap = $nama_lengkap;
    $this->nim = $nim;
    $this->url_transkrip_mk = $url_transkrip_mk;
    $this->ipk = $ipk;
    $this->semester = $semester;
    $this->nomor_rekening = $nomor_rekening;
    $this->nomor_telepon = $nomor_telepon;
    $this->email = $email;
    $this->password = $password;
    $this->created_at = $created_at;
  }

  public function getId(): MahasiswaId
  {
    return $this->id;
  }

  public function getNamaLengkap(): string
  {
    return $this->nama_lengkap;
  }

  public function getNim(): string
  {
    return $this->nim;
  }

  public function getUrlTranskripMk(): string
  {
    return $this->url_transkrip_mk;
  }

  public function getIpk(): float
  {
    return $this->ipk;
  }

  public function getSemester(): int
  {
    return $this->semester;
  }

  public function getNomorRekening(): string
  {
    return $this->nomor_rekening;
  }

  public function getNomorTelepon(): string
  {
    return $this->nomor_telepon;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function getCreatedAt(): DateTime
  {
    return $this->created_at;
  }
}
