<template v-if="selected.kecamatan">
@component('components.card', ['class' => 'bg-light'])
    @slot('header')
        Kecamatan Terpilih:
        <div class="card-header-actions">
            <a v-on:click.prevent="clearKecamatan"
                class="card-header-action btn-close"
                title="close"
                style="cursor: pointer;"
                >
                <i class="icon-close"></i>
            </a>
        </div>
    @endslot
    <h5>@{{ selected.kecamatan.name }}, @{{ selected.kecamatan.kota_kabupaten_name }}</h5>
@endcomponent
</template>

<data-table v-bind.sync="kelurahan" ref="table">
    <div slot="form">
        <b-form-group label="Provinsi:" v-bind="kelurahan.form.feedback('provinsi_id')">
            <ajax-select
                url="{{ action('Master\Wilayah\ProvinsiController@index') }}"
                label="name"
                placeholder="Pilih Provinsi"
                v-model="kelurahan.form.provinsi"
                v-bind:key-value.sync="kelurahan.form.provinsi_id"
                v-on:select="kelurahan.form.errors.clear('provinsi_id')"
                v-on:input="kelurahan.form.kota_kabupaten = null"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Kota/Kabupaten:" v-bind="kelurahan.form.feedback('kota_kabupaten_id')">
            <ajax-select
                :params="{provinsi: kelurahan.form.provinsi_id}"
                url="{{ action('Master\Wilayah\KotaKabupatenController@index') }}"
                label="name"
                placeholder="Pilih Kecamatan"
                v-model="kelurahan.form.kota_kabupaten"
                v-bind:key-value.sync="kelurahan.form.kota_kabupaten_id"
                v-on:select="kotakabupaten.form.errors.clear('kota_kabupaten_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Kecamatan:" v-bind="kelurahan.form.feedback('kecamatan_id')">
            <ajax-select
                :params="{kota_kabupaten: kelurahan.form.kota_kabupaten_id}"
                url="{{ action('Master\Wilayah\KecamatanController@index') }}"
                label="name"
                placeholder="Pilih Kecamatan"
                v-model="kelurahan.form.kecamatan"
                v-bind:key-value.sync="kelurahan.form.kecamatan_id"
                v-on:select="kotakabupaten.form.errors.clear('kecamatan_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Name:" v-bind="kelurahan.form.feedback('name')">
            <input
                class="form-control"
                name="name"
                placeholder="Name"
                type="text"
                v-model="kelurahan.form.name"
                >
            </input>
        </b-form-group>

    </div>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            kelurahan: {
                sortBy: 'kecamatan_name',
                url   : `{{ action('Master\Wilayah\KelurahanController@index') }}`,
                dataMap(item) {
                    return {
                        // kota_kabupaten   : item.kecamatan.kota_kabupaten,
                        // kota_kabupaten_id: item.kecamatan.kota_kabupaten_id,
                        // provinsi         : item.kecamatan.kota_kabupaten.provinsi,
                        // provinsi_id      : item.kecamatan.kota_kabupaten.provinsi_id,
                        ...item
                    }
                },
                fields: [
                    {
                        label    : 'Nama Kota/Kabupaten',
                        key      : 'kota_kabupaten_name',
                        sortable : true
                    },
                    {
                        label    : 'Nama Kecamatan',
                        key      : 'kecamatan_name',
                        sortable : true
                    },
                    {
                        key     : 'name',
                        sortable: true,
                    },
                ],
                form: new Form(
                    {
                        name             : null,
                        kota_kabupaten_id: null,
                        kecamatan_id     : null,
                        provinsi_id      : null,
                    },
                    {
                        kecamatan        : null,
                        kota_kabupaten   : null,
                        provinsi         : null
                    }
                ),
            }
        }
    },
    methods: {
        clearKecamatan() {
            this.selected.kecamatan = null;

            this.kelurahan.url      = `{{ action('Master\Wilayah\KelurahanController@index') }}`;
            this.kelurahan.sortBy   = 'kecamatan_name';

            this.kelurahan.form.setDefault('kecamatan', item);

            this.kelurahan.form.setDefault('kecamatan_id', null);

            this.kelurahan.form.setDefault('kota_kabupaten', null);

            this.kelurahan.form.setDefault('kota_kabupaten_id', null);

            this.kelurahan.form.setDefault('provinsi', null);

            this.kelurahan.form.setDefault('provinsi_id', null);
        }
    }
});
</script>
@endpush