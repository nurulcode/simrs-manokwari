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
    <template slot="klasifikasi" slot-scope="{value}">
        @{{ value.kode }} - @{{ value.uraian }}
    </template>
</data-table>

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
            kelompok: {
                sortBy: 'kode',
                url   : `{{ action('Master\Penyakit\KelompokPenyakitController@index') }}`,
                fields: [{
                    key     : 'klasifikasi'
                },{
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
                    this.selected.kelompok = item;

                    this.penyakit.url    = `${item.path}/penyakit`;

                    this.penyakit.form.setDefault('kelompok', item);

                    this.penyakit.form.setDefault('kelompok_id', item.id);

                    this.selected_tab = 2;
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
    }
});
</script>
@endpush