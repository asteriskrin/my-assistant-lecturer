<?php

namespace App\Core\Domain\Model;

use DateTime;
use App\Core\Domain\Model\DosenId;

class Dosen
{
  private DosenId $id;
  private string $nama_lengkap;
  private string $nip;
  private string $nomor_telepon;
  private string $email;
  private string $password;
  private DateTime $created_at;

  public function __construct(
    DosenId $id,
    string $nama_lengkap,
    string $nip,
    string $nomor_telepon,
    string $email,
    string $password,
    ?DateTime $created_at
  ) {
    if ($nama_lengkap == '\0') throw new \InvalidArgumentException("nama_lengkap can not be null string.");
    if ($nip == '\0') throw new \InvalidArgumentException("nip can not be null string.");
    if ($nomor_telepon == '\0') throw new \InvalidArgumentException("nomor_telepon can not be null string.");
    if ($email == '\0') throw new \InvalidArgumentException("email can not be null string.");
    if ($password == '\0') throw new \InvalidArgumentException("password can not be null string.");
    if ($created_at == NULL) $created_at = new DateTime;

    $this->id = $id;
    $this->nama_lengkap = $nama_lengkap;
    $this->nip = $nip;
    $this->nomor_telepon = $nomor_telepon;
    $this->email = $email;
    $this->password = $password;
    $this->created_at = $created_at;
  }

  public function getId(): DosenId
  {
    return $this->id;
  }

  public function getNamaLengkap(): string
  {
    return $this->nama_lengkap;
  }

  public function getNip(): string
  {
    return $this->nip;
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
