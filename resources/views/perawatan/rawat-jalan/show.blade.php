<?php
use App\Models\Master\Kasus;
use App\Models\Master\JenisRujukan;
use App\Models\Master\CaraPembayaran;

?>

@extends('layouts.coreui')

@section('title', 'Pasien Rawat Jalan')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-12">
            @include('kunjungan.pasien-card', ['pasien' => $rawat_jalan->kunjungan->pasien])
        </div>
        <div class="col-lg-9 col-md-12">
            @include('perawatan.rawat-jalan.single')
        </div>
    </div>


@endsection