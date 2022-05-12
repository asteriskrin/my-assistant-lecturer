<?php

namespace App\Core\Application\Service\TutupLowongan;

class TutupLowonganRequest {
    public function __construct(
        public string $lowonganId,
    )
    { }
}