@extends('layouts.tabs')

@section('title', 'Master Wilayah Management')

@section('tabs')

<b-tab title="Provinsi">
    @include('master.wilayah.provinsi')
</b-tab>

<b-tab title="KotaKabupaten">
    @include('master.wilayah.kotakabupaten')
</b-tab>

<b-tab title="Kecamatan">
    @include('master.wilayah.kecamatan')
</b-tab>

<b-tab title="Kelurahan">
    @include('master.wilayah.kelurahan')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected: {
                provinsi      : null,
                kota_kabupaten: null,
                kecamatan     : null,
            }
        }
    },
});
</script>
@endpush
