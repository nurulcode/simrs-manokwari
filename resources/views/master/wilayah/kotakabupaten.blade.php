<template v-if="selected.provinsi">
@component('components.card', ['class' => 'bg-light'])
    @slot('header')
        Provinsi Terpilih:
        <div class="card-header-actions">
            <a v-on:click.prevent="clearProvinsi"
                class="card-header-action btn-close"
                title="close"
                style="cursor: pointer;"
                >
                <i class="icon-close"></i>
            </a>
        </div>
    @endslot
    <h5>@{{ selected.provinsi.name }}</h5>
@endcomponent
</template>

<data-table v-bind.sync="kota_kabupaten" ref="table">
    <div slot="form">
        <b-form-group label="Provinsi:" v-bind="kota_kabupaten.form.feedback('provinsi_id')">
            <ajax-select
                url="{{ action('Master\Wilayah\ProvinsiController@index') }}"
                label="name"
                placeholder="Pilih Provinsi"
                v-model="kota_kabupaten.form.provinsi"
                v-bind:key-value.sync="kota_kabupaten.form.provinsi_id"
                v-on:select="kota_kabupaten.form.errors.clear('provinsi_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Name:" v-bind="kota_kabupaten.form.feedback('name')">
            <input
                class="form-control"
                name="name"
                placeholder="Name"
                type="text"
                v-model="kota_kabupaten.form.name"
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
            kota_kabupaten: {
                sortBy: 'provinsi_name',
                url   : `{{ action('Master\Wilayah\KotaKabupatenController@index') }}`,
                fields: [
                    {
                        key      : 'provinsi_name',
                        label    : 'Nama Provinsi',
                        sortable : true
                    },
                    {
                        key     : 'name',
                        sortable: true,
                    },
                ],
                form: new Form(
                    {
                        name       : null,
                        provinsi_id: null
                    },
                    {
                        provinsi   : null,
                    }
                ),
                onDoubleClicked: (item, index, event) => {
                    this.selected.kota_kabupaten = item;

                    this.kecamatan.url    = `${item.path}/kecamatan`;

                    this.kecamatan.sortBy = `name`;

                    this.kecamatan.form.setDefault('kota_kabupaten', item);

                    this.kecamatan.form.setDefault('kota_kabupaten_id', item.id);

                    this.kecamatan.form.setDefault('provinsi', item.provinsi);

                    this.kecamatan.form.setDefault('provinsi_id', item.provinsi_id);

                    this.selected_tab = 2;
                },
            }
        }
    },
    methods: {
        clearProvinsi() {
            this.selected.provinsi  = null;

            this.kota_kabupaten.form.setDefault('provinsi', null);

            this.kota_kabupaten.form.setDefault('provinsi_id', null);

            this.kota_kabupaten.url    = `{{ action('Master\Wilayah\KotaKabupatenController@index') }}`;

            this.kota_kabupaten.sortBy = 'provinsi_name';

        }
    }
});
</script>
@endpush