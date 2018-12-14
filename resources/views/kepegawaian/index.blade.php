@extends('layouts.tabs')

@section('title', 'Kepegawaian Data Management')

@section('tabs')

<b-tab title="Jabatan">
    @include('kepegawaian.jabatan')
</b-tab>

<b-tab title="Kategori Kualifikasi">
    @include('kepegawaian.kategori')
</b-tab>


@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_kategori: null,
        }
    },
    watch: {

    }
});
</script>
@endpush
