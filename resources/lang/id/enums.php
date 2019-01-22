<?php

use App\Enums\JenisKelamin;
use App\Enums\CaraPenerimaan;
use App\Enums\KelasTarif;
use App\Enums\JenisTarif;
use App\Enums\KeadaanKeluar;
use App\Enums\CaraKeluar;

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
    ],
    KeadaanKeluar::class => [
        KeadaanKeluar::SEMBUH               => 'Sembuh',
        KeadaanKeluar::MEMBAIK              => 'Membaik',
        KeadaanKeluar::BELUM_SEMBUH         => 'Belum Sembuh',
        KeadaanKeluar::MATI_SEBELUM_48_JAM  => 'Mati Sebelum 48 Jam',
        KeadaanKeluar::MATI_SETELAH_48_JAM  => 'Mati Setelah 48 Jam',
    ],
    CaraKeluar::class => [
        CaraKeluar::DIIJINKAN                   => 'Diijinkan Pulang',
        CaraKeluar::PULANG_PAKSA                => 'Pulang Paksa',
        CaraKeluar::DIRUJUK                     => 'Dirujuk',
        CaraKeluar::DIKEMBALIKAN_KE_PUSKESMAS   => 'Dikembalikan ke Puskesmas',
        CaraKeluar::DIKEMBALIKAN_KE_FASLIAN     => 'Dikembalikan ke Fasilitas Kes. Lain',
        CaraKeluar::DIKEMBALIKAN_KE_RS          => 'Dikembalikan ke RS Asal',
        CaraKeluar::LARI                        => 'Lari',
        CaraKeluar::PINDAH_RS                   => 'Pindah Ke RS Lain'
    ]
];
