@extends('layouts.coreui')

@section('title', 'Pasien Rawat Jalan')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-12">
            @include('kunjungan.pasien-card', ['pasien' => $kunjungan->pasien])
        </div>
        <div class="col-lg-9 col-md-12"> @include('kunjungan.edit') </div>
    </div>
@endsection
