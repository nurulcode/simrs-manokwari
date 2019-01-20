<?php

use App\Enums\JenisKelamin;
use App\Enums\CaraPenerimaan;
use App\Enums\KelasTarif;
use App\Enums\JenisTarif;

return [
    JenisKelamin::class => [
        JenisKelamin::MALE   => 'Laki-laki',
        JenisKelamin::FEMALE => 'Perempuan',
    ],
    CaraPenerimaan::class => [
        CaraPenerimaan::URJ   => 'URJ',
        CaraPenerimaan::IRD   => 'IRD',
        CaraPenerimaan::TP2RI => 'Langsung TP2RI'
    ],
    KelasTarif::class => [
        KelasTarif::TARIF_UMUM  => 'Tarif Umum',
        KelasTarif::KELAS_I     => 'Kelas I',
        KelasTarif::KELAS_II    => 'Kelas II',
        KelasTarif::KELAS_III   => 'Kelas III',
        KelasTarif::KELAS_VIP   => 'Kelas VIP',
        KelasTarif::KELAS_VVIP  => 'Kelas VVIP',
        KelasTarif::KELAS_KS    => 'Kelas Khusus'
    ],
    JenisTarif::class => [
        JenisTarif::SARANA      => 'Tarif Sarana',
        JenisTarif::PELAYANAN   => 'Tarif Pelayanan',
        JenisTarif::BHP         => 'Tarif BHP',
    ]
];
