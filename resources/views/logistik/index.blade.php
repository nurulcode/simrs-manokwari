@extends('layouts.tabs')

@section('title', 'Logistik Management')

@section('tabs')

<b-tab title="Jenis Logistik">
    @include('logistik.jenis')
</b-tab>

<b-tab title="Logistik">
    @include('logistik.logistik')
</b-tab>


@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_jenis  : null,
        }
    },
    watch: {
        selected_jenis(value) {
            // this.ruangan.params.poliklinik = value && value.id;

            // this.ruangan.form.setDefault('poliklinik', value);

            // this.ruangan.form.setDefault('poliklinik_id', value && value.id);

            this.selected_tab = value ? 1 : this.selected_tab;
        },
    }
});
</script>
@endpush
