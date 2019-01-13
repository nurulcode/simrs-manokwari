<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class KelasTarif extends Enum
{
    const RAWAT_JALAN   = 0;
    const RAWAT_DARURAT = 0;
    const KELAS_I       = KelasRuangan::I;
    const KELAS_II      = KelasRuangan::II;
    const KELAS_III     = KelasRuangan::III;
    const KELAS_VIP     = KelasRuangan::VIP;
    const KELAS_VVIP    = KelasRuangan::VVIP;
    const KELAS_KS      = KelasRuangan::KS;
}
