@extends('layouts.tabs')

@section('title', 'Master Wilayah Management')

@section('tabs')

<b-tab title="Poliklinik">
    @include('fasilitas.poliklinik')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected: {
                poliklinik: null,
            }
        }
    },
});
</script>
@endpush
