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
            <b-card no-body>
                <b-tabs lazy card>
                    <b-tab title="Diagnosa" active>
                        @include('perawatan.tabs.diagnosa')
                    </b-tab>
                    <b-tab title="second" >
                        <br>I'm the second tab content
                    </b-tab>
                    <b-tab title="disabled" disabled>
                        <br>Disabled tab!
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>
    </div>


@endsection