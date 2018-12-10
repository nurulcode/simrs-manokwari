@extends('layouts.tabs')

@section('title', 'Master Wilayah Management')

@section('tabs')

<b-tab title="Poliklinik">
    @include('fasilitas.poliklinik')
</b-tab>

<b-tab title="Ruangan">
    @include('fasilitas.ruangan')
</b-tab>

<b-tab title="Kamar">
    @include('fasilitas.kamar')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected: {
                poliklinik: null,
                ruangan   : null
            }
        }
    },
});
</script>
@endpush
