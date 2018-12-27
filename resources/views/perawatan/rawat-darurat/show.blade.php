@extends('layouts.coreui')

@section('title', 'Pasien Rawat Darurat')

@section('content')

@include('kunjungan.banner', [
    'title'     => $rawat_darurat->poliklinik->nama,
    'kunjungan' => $rawat_darurat->kunjungan
])

<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Diagnosa" active>
            @include('layanan.diagnosa', ['perawatan' => $rawat_darurat])
        </b-tab>
    </b-tabs>
</b-card>
@endsection