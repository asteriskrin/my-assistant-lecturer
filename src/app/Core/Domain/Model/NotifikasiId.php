<?php

namespace App\Core\Domain\Model;

use Ramsey\Uuid\Uuid;

class NotifikasiId {
    private string $id;

    public function __construct(string $id) {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        }
        else {
            throw new \InvalidArgumentException("Invalid NotifikasiId format.");
        }
    }

    public function id() : string {
        return $this->id;
    }

    public function equals(NotifikasiId $notifikasiId) {
        return $this->id == $notifikasiId->id();
    }

    public static function make() : NotifikasiId {
        // Generate a new ID based on time
        $id = Uuid::uuid1();

        return new NotifikasiId($id);
    }
}