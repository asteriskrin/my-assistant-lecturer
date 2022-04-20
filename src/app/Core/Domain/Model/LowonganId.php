<?php

namespace App\Core\Domain\Model;

use Ramsey\Uuid\Uuid;

class LowonganId {
    private string $id;

    public function __construct(string $id) {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        }
        else {
            throw new \InvalidArgumentException("Invalid LowonganId format.");
        }
    }

    public function id() : string {
        return $this->id;
    }

    public function equals(LowonganId $lowonganId) {
        return $this->id == $lowonganId->id();
    }

    public static function make() : LowonganId {
        // Generate a new ID based on time
        $id = Uuid::uuid1();

        return new LowonganId($id);
    }
}