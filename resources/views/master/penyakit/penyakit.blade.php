<template v-if="selected.kelompok">
    @component('components.card', ['class' => 'bg-light'])
        @slot('header')
            Kelompok Terpilih:
            <div class="card-header-actions">
                <a v-on:click.prevent="clearKelompok"
                    class="card-header-action btn-close"
                    title="close"
                    style="cursor: pointer;"
                    >
                    <i class="icon-close"></i>
                </a>
            </div>
        @endslot
        <h5>
            @{{ selected.kelompok.kode }} -
            @{{ selected.kelompok.icd }}  -
            @{{ selected.kelompok.uraian }}
        </h5>
    @endcomponent
</template>
<data-table v-bind.sync="penyakit" ref="table">
    <div slot="form">
        <b-form-group label="Klasifikasi Penyakit:" v-bind="penyakit.form.feedback('klasifikasi_id')">
            <ajax-select
                :url="klasifikasi.url"
                label="uraian"
                placeholder="Pilih Klasifikasi Penyakit"
                v-model="penyakit.form.klasifikasi"
                v-bind:key-value.sync="penyakit.form.parent_id"
                v-on:change="penyakit.form.errors.clear('parent_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Kode:" v-bind="penyakit.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="penyakit.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group label="Uraian:" v-bind="penyakit.form.feedback('uraian')">
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="penyakit.form.uraian"
                >
            </input>
        </b-form-group>
    </div>
    <template slot="kelompok" slot-scope="{value}">
        @{{ value.icd }} -
        @{{ value.uraian }}
    </template>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    methods: {
        clearKelompok() {
            this.selected.kelompok = null;

            this.penyakit.url = `{{ action('Master\Penyakit\PenyakitController@index') }}`;

            this.penyakit.form.setDefault('klasifikasi', null);

            this.penyakit.form.setDefault('klasifikasi_id', null);
        }
    },
    data() {
        return {
            penyakit: {
                sortBy: 'icd',
                url   : `{{ action('Master\Penyakit\PenyakitController@index') }}`,
                fields: [{
                    key     : 'kelompok'
                },{
                    key     : 'icd',
                    label   : 'ICD',
                    sortable: true,
                },{
                    key     : 'uraian',
                    sortable: true,
                }],
                form: new Form({
                    uraian        : null,
                    icd           : null,
                    kelompok_id: null
                },{
                    kelompok   : null
                }),
            }
        }
    }
});
</script>
@endpush