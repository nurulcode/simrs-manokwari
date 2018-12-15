@extends('layouts.tabs')

@section('title', 'Kepegawaian Data Management')

@section('tabs')

<b-tab title="Daftar Pegawai">
    @include('kepegawaian.pegawai')
</b-tab>

<b-tab title="Jabatan">
    @include('kepegawaian.jabatan')
</b-tab>

<b-tab title="Kategori Kualifikasi">
    @include('kepegawaian.kategori')
</b-tab>

<b-tab title="Kualifikasi">
    @include('kepegawaian.kualifikasi')
</b-tab>


@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_kategori   : null,
            selected_jabatan    : null,
            selected_kualifikasi: null
        }
    },
    watch: {
        selected_jabatan(value) {
            if (value) {

                this.pegawai.url    = `${value.path}/pegawai`;
                this.pegawai.sortBy = `id`;

                this.pegawai.form.setDefault('jabatan', value);
                this.pegawai.form.setDefault('jabatan_id', value.id);

                this.selected_tab = 0;
            } else {
                this.pegawai.url = `{{ action('Kepegawaian\PegawaiController@index') }}`;
                this.pegawai.sortBy = 'nama';

                this.pegawai.form.setDefault('jabatan', null);
                this.pegawai.form.setDefault('jabatan_id', null);
            }

        },
        selected_kualifikasi(value) {
            if (value) {

                this.pegawai.url    = `${value.path}/pegawai`;
                this.pegawai.sortBy = `id`;

                this.pegawai.form.setDefault('kualifikasi', value);
                this.pegawai.form.setDefault('kualifikasi_id', value.id);

                this.selected_tab = 0;
            } else {
                this.pegawai.url = `{{ action('Kepegawaian\PegawaiController@index') }}`;
                this.pegawai.sortBy = 'nama';

                this.pegawai.form.setDefault('kualifikasi', null);
                this.pegawai.form.setDefault('kualifikasi_id', null);
            }

        },
        selected_kategori(value) {
            if (value) {
                this.kualifikasi.url    = `${value.path}/kualifikasi`;
                this.kualifikasi.sortBy = `id`;

                this.kualifikasi.form.setDefault('kategori', value);
                this.kualifikasi.form.setDefault('kategori_id', value.id);

                this.selected_tab = 3;
            } else {

                this.kualifikasi.url    = `{{ action('Kepegawaian\KualifikasiController@index') }}`;
                this.kualifikasi.sortBy = `kategori_id`;

                this.kualifikasi.form.setDefault('kategori', null);
                this.kualifikasi.form.setDefault('kategori_id', null);

            }
        },
        selected_tab(value, before) {
            switch(before) {
                case 0:
                    this.selected_kualifikasi = null;
                    this.selected_jabatan     = null;
                    break;
                case 3:
                    this.selected_kategori = null;
                    break;
            }
        }
    }
});
</script>
@endpush
