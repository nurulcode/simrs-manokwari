@extends('layouts.coreui')

@section('title', 'Pasien Rawat Inap')

@section('content')

@component('kunjungan.banner', ['kunjungan' => $kunjungan, 'title' => $title])
    @if (!$perawatan->waktu_keluar)
        @slot('footer')
            <button v-on:click="pindah" class="btn btn-success">Pindah Kamar</button>

            <button v-on:click="pulang" class="btn btn-warning">Pasien Pulang</button>
        @endslot
    @endif
@endcomponent

<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Diagnosa" active> @include('layanan.diagnosa') </b-tab>
        <b-tab title="Tindakan/Pemeriksaan"> @include('layanan.tindakan') </b-tab>
        <b-tab title="Pemeriksaan Umum"> @include('layanan.pemeriksaan') </b-tab>
        <b-tab title="Visite"> @include('layanan.visite') </b-tab>
        <b-tab title="Perawatan Khusus"> @include('layanan.keperawatan') </b-tab>
        <b-tab title="Oksigen"> @include('layanan.oksigen') </b-tab>
        <b-tab title="Gizi"> @include('layanan.gizi') </b-tab>
        <b-tab title="Mutasi Kamar"> @include('layanan.mutasi-kamar') </b-tab>
    </b-tabs>
</b-card>

@include('perawatan.rawat-inap.pindah')
@include('perawatan.rawat-inap.pulang')

@endsection