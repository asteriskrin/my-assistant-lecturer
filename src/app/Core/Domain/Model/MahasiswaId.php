<?php

namespace App\Core\Domain\Model;

use Ramsey\Uuid\Uuid;

class MahasiswaId
{
    private string $id;

    public function __construct(string $id)
    {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException("Invalid MahasiswaId format.");
        }
    }

    public function id(): string
    {
        return $this->id;
    }

    public function equals(MahasiswaId $mahasiswaId)
    {
        return $this->id == $mahasiswaId->id();
    }

    public static function make(): MahasiswaId
    {
        // Generate a new ID based on time
        $id = Uuid::uuid1();

        return new MahasiswaId($id);
    }
}
