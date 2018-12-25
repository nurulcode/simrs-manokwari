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
            @include('kunjungan.pasien-card', [
                'nomor_kunjungan' => $rawat_jalan->kunjungan->nomor_kunjungan,
                'waktu_kunjungan' => $rawat_jalan->waktu_kunjungan,
                'pasien'          => $rawat_jalan->kunjungan->pasien
            ])
        </div>
        <div class="col-lg-9 col-md-12">
            <h5>{{ $rawat_jalan->poliklinik->nama }}</h5>
            <br>
            @include('perawatan.rawat-jalan.layanans')
        </div>
    </div>


@endsection