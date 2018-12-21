@extends('layouts.single-card')

@section('title', 'Master Jenis Registrasi Management')

@section('card')
    <data-table v-bind.sync="resource" ref="table"
        @cannot('create', App\Models\Tarif\TarifRegistrasi::class)
            no-add-button-text
        @endcannot
        >
        <div slot="form">
            <b-form-group v-bind="resource.form.feedback('uraian')">
                <b slot="label">Uraian:</b>
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="resource.form.uraian"
                    >
                </input>
            </b-form-group>
            <b-form-group v-bind="resource.form.feedback('kategori')">
                <b slot="label">Kategori:</b>
                <b-form-select
                    :options="{{ json_encode(App\Enums\KategoriRegistrasi::toSelectOptions()) }}"
                    v-on:change="resource.errors.clear('kategori')"
                    v-model="resource.form.kategori">
                    <template slot="first">
                        <option :value="null" disabled>Pilih Kategori Registrasi</option>
                    </template>
                </b-form-select>
            </b-form-group>
            <div class="row">
                <div class="col">
                    <b-form-group v-bind="resource.form.feedback('tarif_sarana')">
                        <b slot="label">Tarif Sarana:</b>
                        <input
                            class="form-control"
                            name="tarif_sarana"
                            type="number"
                            v-model="resource.form.tarif_sarana"
                            >
                        </input>
                    </b-form-group>
                </div>
                <div class="col">
                    <b-form-group v-bind="resource.form.feedback('tarif_pelayanan')">
                        <b slot="label">Tarif Pelayanan:</b>
                        <input
                            class="form-control"
                            name="tarif_pelayanan"
                            type="number"
                            v-model="resource.form.tarif_pelayanan"
                            >
                        </input>
                    </b-form-group>
                </div>
                <div class="col">
                    <b-form-group v-bind="resource.form.feedback('tarif_bhp')">
                        <b slot="label">Tarif BHP:</b>
                        <input
                            class="form-control"
                            name="tarif_bhp"
                            type="number"
                            v-model="resource.form.tarif_bhp"
                            >
                        </input>
                    </b-form-group>
                </div>
            </div>
        </div>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            resource: {
                url   : `{{ action('Tarif\TarifRegistrasiController@index') }}`,
                sortBy: 'id',
                fields: [{
                    key      : 'uraian',
                    sortable : true,
                },{
                    key      : 'tarif_sarana',
                    sortable : true,
                },{
                    key      : 'tarif_pelayanan',
                    sortable : true,
                },{
                    key      : 'tarif_bhp',
                    label    : 'Tarif BHP',
                    sortable : true,
                }],
                form: new Form({
                    kategori       : null,
                    uraian         : null,
                    tarif_sarana   : 0,
                    tarif_pelayanan: 0,
                    tarif_bhp      : 0
                }),
            }
        }
    },
});
</script>
@endpush
