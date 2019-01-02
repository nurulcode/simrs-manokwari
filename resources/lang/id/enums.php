<?php

use App\Enums\JenisKelamin;
use App\Enums\CaraPenerimaan;

return [
    JenisKelamin::class => [
        JenisKelamin::MALE   => 'Laki-laki',
        JenisKelamin::FEMALE => 'Perempuan',
    ],
    CaraPenerimaan::class => [
        CaraPenerimaan::URJ   => 'URJ',
        CaraPenerimaan::IRD   => 'IRD',
        CaraPenerimaan::TP2RI => 'Langsung TP2RI'
    ]
];
