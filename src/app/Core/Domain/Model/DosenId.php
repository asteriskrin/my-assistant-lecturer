<?php

namespace App\Core\Domain\Model;

use Ramsey\Uuid\Uuid;

class DosenId {
    private string $id;

    public function __construct(string $id) {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        }
        else {
            throw new \InvalidArgumentException("Invalid DosenId format.");
        }
    }

    public function id() : string {
        return $this->id;
    }

    public function equals(DosenId $dosenId) {
        return $this->id == $dosenId->id();
    }

    public static function make() : DosenId {
        // Generate a new ID based on time
        $id = Uuid::uuid1();

        return new DosenId($id);
    }
}