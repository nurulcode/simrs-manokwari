<data-table v-bind.sync="ruangan" ref="table"
    @cannot('create', App\Models\Fasilitas\Ruangan::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group label="Poliklinik:" v-bind="ruangan.form.feedback('poliklinik_id')">
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Poliklinik"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="ruangan.form.poliklinik"
                v-bind:key-value.sync="ruangan.form.poliklinik_id"
                v-on:select="ruangan.form.errors.clear('poliklinik_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Kode:" v-bind="ruangan.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="ruangan.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group label="Nama:" v-bind="ruangan.form.feedback('nama')">
            <input
                class="form-control"
                name="nama"
                placeholder="Nama"
                type="text"
                v-model="ruangan.form.nama"
                >
            </input>
        </b-form-group>
        <div class="row">
            <div class="col">
                <b-form-group label="Jenis:" v-bind="ruangan.form.feedback('jenis')">
                    <multiselect
                        :options="{{ json_encode(App\Enums\JenisRuangan::toSelectOptions()) }}"
                        deselect-label=""
                        label="label"
                        placeholder="Pilih Jenis Ruangan"
                        select-label=""
                        track-by="value"
                        v-model="ruangan.form.jenis"
                        v-on:select="ruangan.form.errors.clear('jenis')"
                        >
                    </multiselect>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Kelas:" v-bind="ruangan.form.feedback('kelas')">
                    <multiselect
                        :options="{{ json_encode(App\Enums\KelasRuangan::toSelectOptions()) }}"
                        deselect-label=""
                        label="label"
                        placeholder="Pilih Kelas Ruangan"
                        select-label=""
                        track-by="value"
                        v-model="ruangan.form.kelas"
                        v-on:select="ruangan.form.errors.clear('kelas')"
                        >
                    </multiselect>
                </b-form-group>
            </div>
        </div>
    </div>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            ruangan: {
                sortBy: `kode`,
                url   : `{{ action('Fasilitas\RuanganController@index') }}`,
                fields: [{
                    key      : 'kode',
                    sortable : true,
                    formatter: item => item.toUpperCase()
                },{
                    key      : 'nama',
                    sortable : true,
                }, {
                    key      : 'kelas',
                    formatter: item => item.label
                },{
                    key      : 'jenis',
                    formatter: item => item.label
                }],
                form: new Form({
                    poliklinik_id: null,
                    kode         : null,
                    nama         : null,
                    jenis        : null,
                    kelas        : null,
                }, {
                    poliklinik   : null,
                }),
            }
        }
    },
});
</script>
@endpush