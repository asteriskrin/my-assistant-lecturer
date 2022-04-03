<?php

namespace App\Core\Domain\Model;

use Ramsey\Uuid\Uuid;

class MataKuliahId {
    private string $id;

    public function __construct(string $id) {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        }
        else {
            throw new \InvalidArgumentException("Invalid MataKuliahId format.");
        }
    }

    public function id() : string {
        return $this->id;
    }

    public function equals(MataKuliahId $mataKuliahId) {
        return $this->id == $mataKuliahId->id();
    }

    public static function make() : MataKuliahId {
        // Generate a new ID based on time
        $id = Uuid::uuid1();

        return new MataKuliahId($id);
    }
}