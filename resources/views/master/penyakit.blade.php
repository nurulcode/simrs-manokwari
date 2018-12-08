@extends('layouts.tabs')

@section('title', 'Master Kegiatan Management')

@section('tabs')

<b-tab title="Klasifikasi Penyakit">
    <data-table v-bind.sync="klasifikasi" ref="table">
        <div slot="form">
            <b-form-group label="Kode:" v-bind="klasifikasi.form.feedback('kode')">
                <input
                    class="form-control"
                    name="kode"
                    placeholder="Kode"
                    type="text"
                    v-model="klasifikasi.form.kode"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Uraian:" v-bind="klasifikasi.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="klasifikasi.form.uraian"
                    >
                </input>
            </b-form-group>
        </div>
    </data-table>
</b-tab>
<b-tab title="Kelompok Penyakit">
    <template v-if="selected.klasifikasi">
        @component('components.card', ['class' => 'bg-light'])
            @slot('header')
                Klasifikasi Terpilih:
                <div class="card-header-actions">
                    <a v-on:click.prevent="clearKlasifikasi"
                        class="card-header-action btn-close"
                        title="close"
                        style="cursor: pointer;"
                        >
                        <i class="icon-close"></i>
                    </a>
                </div>
            @endslot
            <h5>@{{ selected.klasifikasi.kode }} - @{{ selected.klasifikasi.uraian }}</h5>
        @endcomponent
    </template>
    <data-table v-bind.sync="kelompok" ref="table">
        <div slot="form">
            <b-form-group label="Klasifikasi Penyakit:" v-bind="kelompok.form.feedback('klasifikasi_id')">
                <ajax-select
                    :url="klasifikasi.url"
                    label="uraian"
                    placeholder="Pilih Klasifikasi Penyakit"
                    v-model="kelompok.form.klasifikasi"
                    v-bind:key-value.sync="kelompok.form.parent_id"
                    v-on:change="kelompok.form.errors.clear('parent_id')"
                    >
                </ajax-select>
            </b-form-group>
            <b-form-group label="Kode:" v-bind="kelompok.form.feedback('kode')">
                <input
                    class="form-control"
                    name="kode"
                    placeholder="Kode"
                    type="text"
                    v-model="kelompok.form.kode"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Uraian:" v-bind="kelompok.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="kelompok.form.uraian"
                    >
                </input>
            </b-form-group>
        </div>
        <template slot="uraian" slot-scope="{item}">
            @{{ item.uraian }}
            <p class="text-muted">@{{ item.klasifikasi.uraian }}</p>
        </template>
    </data-table>
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    methods: {
        clearKlasifikasi() {
            this.selected.klasifikasi = null;

            this.kelompok.url = `{{ action('Master\Penyakit\KelompokPenyakitController@index') }}`;

            this.kelompok.form.setDefault('klasifikasi', null);

            this.kelompok.form.setDefault('klasifikasi_id', null);
        }
    },
    data() {
        return {
            selected: {
                klasifikasi      : null,
            },
            klasifikasi: {
                sortBy: 'kode',
                url   : `{{ action('Master\Penyakit\KlasifikasiPenyakitController@index') }}`,
                fields: [{
                    key     : 'kode',
                    sortable: true,
                }, {
                    key     : 'uraian',
                    sortable: true,
                }],
                onDoubleClicked: (item, index, event) => {
                    this.selected.klasifikasi = item;

                    this.kelompok.url = `${item.path}/kelompok`;

                    this.kelompok.form.setDefault('klasifikasi', item);

                    this.kelompok.form.setDefault('klasifikasi_id', item.id);

                    this.selected_tab = 1;
                },
                form: new Form({
                    kode  : null,
                    uraian: null
                }),
            },
            kelompok: {
                sortBy: 'kode',
                url   : `{{ action('Master\Penyakit\KelompokPenyakitController@index') }}`,
                fields: [{
                    key     : 'kode',
                    label   : 'Kode DTD',
                    sortable: true,
                },{
                    key     : 'icd',
                    label   : 'ICD',
                    sortable: true,
                },{
                    key     : 'uraian',
                    sortable: true,
                }],
                onDoubleClicked: (item, index, event) => {
                    this.selected.kategori = item;

                    // this.kota_kabupaten.url    = `${item.path}/kota-kabupaten`;
                    // this.kota_kabupaten.sortBy = `name`;

                    // this.kota_kabupaten.form.setDefault('provinsi', item);

                    // this.kota_kabupaten.form.setDefault('provinsi_id', item.id);

                    // this.selected_tab = 1;
                },
                form: new Form({
                    uraian        : null,
                    kode          : null,
                    icd           : null,
                    klasifikasi_id: null
                },{
                    klasifikasi   : null
                }),
            }
        }
    },
});
</script>
@endpush
