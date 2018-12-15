<data-table v-bind.sync="kualifikasi" ref="table"
    @cannot('create', App\Models\Kepegawaian\Kualifikasi::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group label="Kode:" v-bind="kualifikasi.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="kualifikasi.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group label="Uraian:" v-bind="kualifikasi.form.feedback('uraian')">
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="kualifikasi.form.uraian"
                >
            </input>
        </b-form-group>
        <div class="row">
            <div class="col">
                <b-form-group label="Kebutuhan Laki-laki:" v-bind="kualifikasi.form.feedback('laki_laki')">
                    <input
                        class="form-control"
                        name="laki_laki"
                        placeholder="Kebutuhan Laki-laki"
                        type="number"
                        v-model="kualifikasi.form.laki_laki"
                        >
                    </input>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Kebutuhan Perempuan:" v-bind="kualifikasi.form.feedback('perempuan')">
                    <input
                        class="form-control"
                        name="perempuan"
                        placeholder="Kebutuhan Perempuan"
                        type="number"
                        v-model="kualifikasi.form.perempuan"
                        >
                    </input>
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
            kualifikasi: {
                url   : `{{ action('Kepegawaian\KualifikasiController@index') }}`,
                sortBy: 'uraian',
                fields: [{
                    key      : 'kode',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                }],
                form: new Form({
                    kategori_id : null,
                    kode        : null,
                    uraian      : null,
                    laki_laki   : 0,
                    perempuan   : 0,
                }),
            }
        }
    },
});
</script>
@endpush
