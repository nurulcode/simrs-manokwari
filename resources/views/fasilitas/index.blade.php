@extends('layouts.tabs')

@section('title', 'Fasilitas Management')

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

<b-tab title="Ranjang">
    @include('fasilitas.ranjang')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_poliklinik: null,
            selected_ruangan   : null,
            selected_kamar     : null,
        }
    },
    watch: {
        selected_poliklinik(value) {
            if (value) {
                this.ruangan.url    = `${value.path}/ruangan`;

                this.ruangan.sortBy = `nama`;

                this.ruangan.form.setDefault('poliklinik', value);

                this.ruangan.form.setDefault('poliklinik_id', value.id);

                this.selected_tab = 1;
            } else {
                this.ruangan.url    = `{{ action('Fasilitas\RuanganController@index') }}`;

                this.ruangan.sortBy = `kode`;

                this.ruangan.form.setDefault('poliklinik', null);

                this.ruangan.form.setDefault('poliklinik_id', null);
            }
        },
        selected_ruangan(value) {
            if (value) {
                this.kamar.url    = `${value.path}/kamar`;

                this.kamar.sortBy = `nama`;

                this.kamar.form.setDefault('ruangan', value);

                this.kamar.form.setDefault('ruangan_id', value.id);

                this.kamar.form.setDefault('poliklinik', value.poliklinik);

                this.kamar.form.setDefault('poliklinik_id', value.poliklinik_id);

                this.selected_tab = 2;
            } else {
                this.kamar.url    = `{{ action('Fasilitas\KamarController@index') }}`;

                this.kamar.sortBy = `nama_ruangan`,

                this.kamar.form.setDefault('ruangan', null);

                this.kamar.form.setDefault('ruangan_id', null);

                this.kamar.form.setDefault('poliklinik', null);

                this.kamar.form.setDefault('poliklinik_id', null);
            }
        },
        selected_kamar(value) {
            if (value) {
                this.ranjang.url    = `${value.path}/ranjang`;

                this.ranjang.sortBy = `kode`;

                this.ranjang.form.setDefault('kamar', value);

                this.ranjang.form.setDefault('kamar_id', value.id);

                this.ranjang.form.setDefault('ruangan', value.ruangan);

                this.ranjang.form.setDefault('ruangan_id', value.ruangan_id);

                this.ranjang.form.setDefault('poliklinik', value.ruangan.poliklinik);

                this.ranjang.form.setDefault('poliklinik_id', value.ruangan.poliklinik_id);

                this.selected_tab = 3;
            } else {
                this.ranjang.url    = `{{ action('Fasilitas\RanjangController@index') }}`;

                this.ranjang.sortBy = `nama_ruangan`;

                this.ranjang.form.setDefault('kamar', null);

                this.ranjang.form.setDefault('kamar_id', null);

                this.ranjang.form.setDefault('ruangan', null);

                this.ranjang.form.setDefault('ruangan_id', null);

                this.ranjang.form.setDefault('poliklinik', null);

                this.ranjang.form.setDefault('poliklinik_id', null);
            }
        }
    }
});
</script>
@endpush
