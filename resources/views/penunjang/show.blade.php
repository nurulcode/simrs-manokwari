@extends('layouts.coreui')

@section('title', $title)

@section('content')

@component('kunjungan.banner', ['kunjungan' => $kunjungan, 'title' => $title])
    <b-form-group label="Catatan:">
        <textarea
            class="form-control"
            disabled
            placeholder="Catatan"
            readonly>{{ $penunjang->catatan }}
        </textarea>
    </b-form-group>
@endcomponent

<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Tindakan/Pemeriksaan"></b-tab>
    </b-tabs>
</b-card>

@endsection