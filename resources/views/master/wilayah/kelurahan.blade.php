<closable-card v-if="!!selected_kecamatan"
    header="Kecamatan Terpilih:"
    v-on:close="selected_kecamatan = null">
    <h5>@{{ selected_kecamatan.name }}, @{{ selected_kecamatan.kota_kabupaten_name }}</h5>
</closable-card>

<data-table v-bind.sync="kelurahan" ref="table"
    @cannot('create', App\Models\Master\Wilayah\Kelurahan::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group v-bind="kelurahan.form.feedback('provinsi_id')">
            <b slot="label">Provinsi:</b>
            <ajax-select
                placeholder="Pilih Provinsi"
                label="name"
                url="{{ action('Master\Wilayah\ProvinsiController@index') }}"
                v-model="kelurahan.form.provinsi"
                v-bind:key-value.sync="kelurahan.form.provinsi_id"
                v-on:select="kelurahan.form.errors.clear('provinsi_id')"
                v-on:input="kelurahan.form.kota_kabupaten = null"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-if="kelurahan.form.provinsi" v-bind="kelurahan.form.feedback('kota_kabupaten_id')">
            <b slot="label">Kota/Kabupaten:</b>
            <ajax-select
                :url="`${kelurahan.form.provinsi.path}/kota-kabupaten`"
                label="name"
                placeholder="Pilih Kecamatan"
                v-model="kelurahan.form.kota_kabupaten"
                v-bind:key-value.sync="kelurahan.form.kota_kabupaten_id"
                v-on:select="kelurahan.form.errors.clear('kota_kabupaten_id')"
                v-on:input="kelurahan.form.kecamatan = null"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-if="kelurahan.form.kota_kabupaten" v-bind="kelurahan.form.feedback('kecamatan_id')">
            <b slot="label">Kecamatan:</b>
            <ajax-select
                :url="`${kelurahan.form.kota_kabupaten.path}/kecamatan`"
                label="name"
                placeholder="Pilih Kecamatan"
                v-model="kelurahan.form.kecamatan"
                v-bind:key-value.sync="kelurahan.form.kecamatan_id"
                v-on:select="kelurahan.form.errors.clear('kecamatan_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="kelurahan.form.feedback('name')">
            <b slot="label">Name:</b>
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
                        kota_kabupaten   : item.kecamatan.kota_kabupaten,
                        kota_kabupaten_id: item.kecamatan.kota_kabupaten_id,
                        provinsi         : item.kecamatan.kota_kabupaten.provinsi,
                        provinsi_id      : item.kecamatan.kota_kabupaten.provinsi_id,
                        ...item
                    }
                },
                fields: [{
                    label    : 'Nama Kota/Kabupaten',
                    key      : 'kota_kabupaten_name',
                    sortable : true
                },{
                    label    : 'Nama Kecamatan',
                    key      : 'kecamatan_name',
                    sortable : true
                },{
                    key     : 'name',
                    sortable: true,
                }],
                form: new Form({
                    name             : null,
                    kota_kabupaten_id: null,
                    kecamatan_id     : null,
                    provinsi_id      : null,
                },{
                    kecamatan        : null,
                    kota_kabupaten   : null,
                    provinsi         : null
                }),
            }
        }
    }
});
</script>
@endpush