<template v-if="selected.kota_kabupaten">
@component('components.card', ['class' => 'bg-light'])
    @slot('header')
        Kota/Kabupaten Terpilih:
        <div class="card-header-actions">
            <a v-on:click.prevent="clearKotaKabupaten"
                class="card-header-action btn-close"
                title="close"
                style="cursor: pointer;"
                >
                <i class="icon-close"></i>
            </a>
        </div>
    @endslot
    <h5>@{{ selected.kota_kabupaten.name }}, @{{ selected.kota_kabupaten.provinsi_name }}</h5>
@endcomponent
</template>

<data-table v-bind.sync="kecamatan" ref="table">
    <div slot="form">
        <b-form-group label="Provinsi:" v-bind="kecamatan.form.feedback('provinsi_id')">
            <ajax-select
                url="{{ action('Master\Wilayah\ProvinsiController@index') }}"
                label="name"
                placeholder="Pilih Provinsi"
                v-model="kecamatan.form.provinsi"
                v-bind:key-value.sync="kecamatan.form.provinsi_id"
                v-on:select="kecamatan.form.errors.clear('provinsi_id')"
                v-on:input="kecamatan.form.kota_kabupaten = null"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="KotaKabupaten:" v-bind="kecamatan.form.feedback('kota_kabupaten_id')">
            <ajax-select
                :params="{provinsi: kecamatan.form.provinsi_id}"
                url="{{ action('Master\Wilayah\KotaKabupatenController@index') }}"
                label="name"
                placeholder="Pilih Kota/Kabupaten"
                v-model="kecamatan.form.kota_kabupaten"
                v-bind:key-value.sync="kecamatan.form.kota_kabupaten_id"
                v-on:select="kotakabupaten.form.errors.clear('kota_kabupaten_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Name:" v-bind="kecamatan.form.feedback('name')">
            <input
                class="form-control"
                name="name"
                placeholder="Name"
                type="text"
                v-model="kecamatan.form.name"
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
            kecamatan: {
                sortBy: 'kota_kabupaten_name',
                url   : `{{ action('Master\Wilayah\KecamatanController@index') }}`,
                params: {
                    kota_kabupaten: null,
                },
                dataMap(item) {
                    return {
                        provinsi   : item.kota_kabupaten.provinsi,
                        provinsi_id: item.kota_kabupaten.provinsi_id,
                        ...item
                    }
                },
                fields: [
                    {
                        key      : 'provinsi_name',
                        label    : 'Nama Provinsi',
                        sortable : true
                    },
                    {
                        key      : 'kota_kabupaten_name',
                        label    : 'Nama Kota/Kabupaten',
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
                        provinsi_id      : null,
                    },
                    {
                        kota_kabupaten   : null,
                        provinsi         : null
                    }
                ),
                onDoubleClicked: (item, index, event) => {
                    this.selected.kecamatan = item;

                    this.kelurahan.url    = `${item.path}/kelurahan`;

                    this.kelurahan.sortBy = `name`;

                    this.kelurahan.form.setDefault('kecamatan', item);

                    this.kelurahan.form.setDefault('kecamatan_id', item.id);

                    this.kelurahan.form.setDefault('kota_kabupaten', item.kota_kabupaten);

                    this.kelurahan.form.setDefault('kota_kabupaten_id', item.kota_kabupaten_id);

                    this.kelurahan.form.setDefault('provinsi', item.kota_kabupaten.provinsi);

                    this.kelurahan.form.setDefault('provinsi_id', item.kota_kabupaten.provinsi_id);

                    this.selected_tab = 3;
                },
            }
        }
    },
    methods: {
        clearKotaKabupaten() {
            this.selected.kota_kabupaten = null;

            this.kecamatan.url    = `{{ action('Master\Wilayah\KecamatanController@index') }}`;

            this.kecamatan.sortBy = `kota_kabupaten_name`;

            this.kecamatan.form.setDefault('kota_kabupaten', null);

            this.kecamatan.form.setDefault('kota_kabupaten_id', null);

            this.kecamatan.form.setDefault('provinsi', null);

            this.kecamatan.form.setDefault('provinsi_id', null);
        }
    }
});
</script>
@endpush