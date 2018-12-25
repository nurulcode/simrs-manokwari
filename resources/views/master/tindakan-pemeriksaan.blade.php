@extends('layouts.single-card')

@section('title', 'Master Tindakan Pemeriksaan Management')

@section('card')
    <data-table v-bind.sync="tindakan" ref="table">
        <div slot="form">
            <b-form-group label="Kelompok Tindakan:" v-bind="tindakan.form.feedback('parent_id')">
                <ajax-select
                    :url="tindakan.url"
                    label="uraian"
                    placeholder="Pilih Kelompok Tindakan"
                    v-model="tindakan.form.parent"
                    v-bind:key-value.sync="tindakan.form.parent_id"
                    v-on:change="tindakan.form.errors.clear('parent_id')"
                    >
                </ajax-select>
            </b-form-group>
            <b-form-group label="Kode:" v-bind="tindakan.form.feedback('kode')">
                <input
                    class="form-control"
                    name="kode"
                    placeholder="Kode"
                    type="text"
                    v-model="tindakan.form.kode"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Uraian:" v-bind="tindakan.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="tindakan.form.uraian"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Jenis:" v-bind="tindakan.form.feedback('jenis')">
                <b-form-select
                    :options="{{ json_encode(App\Enums\JenisTindakanPemeriksaan::toSelectArray()) }}"
                    v-model="tindakan.form.jenis"
                    v-on:change="tindakan.form.errors.clear('jenis')"
                >
                    <option slot="first" :value="null" disabled>Pilih Jenis Tindakan</option>
                </b-form-select>
            </b-form-group>
            <b-form-group label="Poliklinik:" v-bind="tindakan.form.feedback('poliklinik')">
                <ajax-select
                    :multiple="true"
                    url="{{ action('Fasilitas\PoliklinikController@index') }}"
                    label="nama"
                    placeholder="Pilih Poliklinik"
                    v-model="tindakan.form.polikliniks"
                    >
                </ajax-select>
            </b-form-group>
        </div>
        <template slot="uraian" slot-scope="{item, value}">
            @{{ value }}
            <p>
                <span v-for="poliklinik in item.polikliniks" class="badge badge-primary mr-1">
                    @{{ poliklinik.nama }}
                </span>
            </p>
        </template>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            tindakan: {
                url   : `{{ action('Master\TindakanPemeriksaanController@index') }}`,
                sortBy: 'kode',
                fields: [{
                    key      : 'kode',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                }],
                form: new Form({
                    parent_id  : null,
                    kode       : null,
                    uraian     : null,
                    jenis      : null,
                    polikliniks: []
                },{
                    parent     : null
                }),
            }
        }
    },
});
</script>
@endpush
