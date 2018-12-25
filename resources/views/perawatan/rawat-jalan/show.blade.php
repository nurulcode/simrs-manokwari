<?php
use App\Models\Master\Kasus;
use App\Models\Master\JenisRujukan;
use App\Models\Master\CaraPembayaran;

?>

@extends('layouts.coreui')

@section('title', 'Pasien Rawat Jalan')

@section('content')

    @include('kunjungan.pasien-card', ['pasien' => $rawat_jalan->kunjungan->pasien])

    @component('components.card', ['header' => 'Kunjungan Rawat Jalan'])

    @endcomponent
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

    }
});
</script>
@endpush