@extends('layouts.coreui')

@section('title', $title)

@section('content')

@component('kunjungan.banner', ['kunjungan' => $kunjungan, 'title' => $title])

@endcomponent

<b-card no-body>
    <b-tabs lazy card>
        @include('apotek.resep')
    </b-tabs>
</b-card>

@endsection