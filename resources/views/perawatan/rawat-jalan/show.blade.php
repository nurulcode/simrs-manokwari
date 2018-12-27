@extends('layouts.coreui')

@section('title', 'Pasien Rawat Jalan')

@section('content')

@include('kunjungan.banner', [
    'title'     => $rawat_jalan->poliklinik->nama,
    'kunjungan' => $rawat_jalan->kunjungan
])

<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Diagnosa" active>
            @include('layanan.diagnosa', ['perawatan' => $rawat_jalan])
        </b-tab>
    </b-tabs>
</b-card>
@endsection