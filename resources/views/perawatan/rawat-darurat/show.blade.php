@extends('layouts.coreui')

@section('title', 'Pasien Rawat Darurat')

@section('content')

@include('kunjungan.banner')

<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Diagnosa" active> @include('layanan.diagnosa') </b-tab>
        <b-tab title="Tindakan/Pemeriksaan"> @include('layanan.tindakan') </b-tab>
        <b-tab title="Pemeriksaan Umum"> @include('layanan.pemeriksaan') </b-tab>
    </b-tabs>
</b-card>
@endsection