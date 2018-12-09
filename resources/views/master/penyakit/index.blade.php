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
            selected_klasifikasi: null,
            selected_kelompok   : null
        }
    },
    watch: {
        selected_klasifikasi(value) {
            if (value) {
                this.kelompok.url    = `${value.path}/kelompok`;

                this.kelompok.sortBy = `uraian`;

                this.kelompok.form.setDefault('klasifikasi', value);

                this.kelompok.form.setDefault('klasifikasi_id', value.id);

                this.selected_tab = 1;
            } else {
                this.kelompok.url    = `{{ action('Master\Penyakit\KelompokPenyakitController@index') }}?${Math.random()}`;

                this.kelompok.sortBy = `kode`;

                this.kelompok.form.setDefault('klasifikasi', null);

                this.kelompok.form.setDefault('klasifikasi_id', null);
            }
        },
        selected_kelompok(value) {
            if (value) {
                this.penyakit.url    = `${value.path}/penyakit`;

                this.penyakit.sortBy = `uraian`;

                this.penyakit.form.setDefault('kelompok', value);

                this.penyakit.form.setDefault('kelompok_id', value.id);

                this.selected_tab = 2;
            } else {
                this.penyakit.url    = `{{ action('Master\Penyakit\PenyakitController@index') }}`;

                this.penyakit.sortBy = `icd`;

                this.penyakit.form.setDefault('klasifikasi', null);

                this.penyakit.form.setDefault('klasifikasi_id', null);
            }
        }
    }
});
</script>
@endpush
