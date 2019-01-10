@extends('layouts.coreui')

@section('title', 'Pasien Rawat Inap')

@section('content')

@include('kunjungan.banner')

<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Diagnosa" active> @include('layanan.diagnosa') </b-tab>
    </b-tabs>
</b-card>
@endsection