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
            selected_provinsi      : null,
            selected_kota_kabupaten: null,
            selected_kecamatan     : null,
        }
    },
    watch: {
        selected_provinsi(value) {
            if (value) {
                this.kota_kabupaten.url    = `${value.path}/kota-kabupaten`;

                this.kota_kabupaten.sortBy = `name`;

                this.kota_kabupaten.form.setDefault('provinsi', value);

                this.kota_kabupaten.form.setDefault('provinsi_id', value.id);

                this.selected_tab = 1;
            } else {
                this.kota_kabupaten.form.setDefault('provinsi', null);

                this.kota_kabupaten.form.setDefault('provinsi_id', null);

                this.kota_kabupaten.sortBy = 'provinsi_name';

                this.kota_kabupaten.url    = `{{ action('Master\Wilayah\KotaKabupatenController@index') }}`;
            }
        },
        selected_kota_kabupaten(value) {
            if (value) {
                this.kecamatan.url    = `${value.path}/kecamatan`;

                this.kecamatan.sortBy = `name`;

                this.kecamatan.form.setDefault('kota_kabupaten', value);

                this.kecamatan.form.setDefault('kota_kabupaten_id', value.id);

                this.kecamatan.form.setDefault('provinsi', value.provinsi);

                this.kecamatan.form.setDefault('provinsi_id', value.provinsi_id);

                this.selected_tab = 2;
            } else {
                this.kecamatan.sortBy = `kota_kabupaten_name`;

                this.kecamatan.url    = `{{ action('Master\Wilayah\KecamatanController@index') }}`;

                this.kecamatan.form.setDefault('kota_kabupaten', null);

                this.kecamatan.form.setDefault('kota_kabupaten_id', null);

                this.kecamatan.form.setDefault('provinsi', null);

                this.kecamatan.form.setDefault('provinsi_id', null);
            }
        },
        selected_kecamatan(value) {
            if (value) {
                this.kelurahan.sortBy = `name`;

                this.kelurahan.url    = `${value.path}/kelurahan`;

                this.kelurahan.form.setDefault('kecamatan', value);

                this.kelurahan.form.setDefault('kecamatan_id', value.id);

                this.kelurahan.form.setDefault('kota_kabupaten', value.kota_kabupaten);

                this.kelurahan.form.setDefault('kota_kabupaten_id', value.kota_kabupaten_id);

                this.kelurahan.form.setDefault('provinsi', value.kota_kabupaten.provinsi);

                this.kelurahan.form.setDefault('provinsi_id', value.kota_kabupaten.provinsi_id);

                this.selected_tab = 3;
            } else {

                this.kelurahan.sortBy   = 'kecamatan_name';

                this.kelurahan.url      = `{{ action('Master\Wilayah\KelurahanController@index') }}`;

                this.kelurahan.form.setDefault('kecamatan', null);

                this.kelurahan.form.setDefault('kecamatan_id', null);

                this.kelurahan.form.setDefault('kota_kabupaten', null);

                this.kelurahan.form.setDefault('kota_kabupaten_id', null);

                this.kelurahan.form.setDefault('provinsi', null);

                this.kelurahan.form.setDefault('provinsi_id', null);
            }
        }
    }
});
</script>
@endpush
