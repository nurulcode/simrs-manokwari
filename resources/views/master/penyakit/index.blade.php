@extends('layouts.tabs')

@section('title', 'Master Kegiatan Management')

@section('tabs')

<b-tab title="Klasifikasi Penyakit">
    @include('master.penyakit.klasifikasi')
</b-tab>

<b-tab title="Kelompok Penyakit">
    @include('master.penyakit.kelompok')
</b-tab>

<b-tab title="Penyakit">
    @include('master.penyakit.penyakit')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected: {
                klasifikasi: null,
                kelompok   : null
            }
        }
    },
});
</script>
@endpush
