<?php

namespace App\Core\Application\Service\HapusLowongan;

class HapusLowonganRequest {
    public function __construct(
        public string $lowonganId,
    )
    { }
}