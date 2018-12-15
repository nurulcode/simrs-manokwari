<data-table v-bind.sync="kategori" ref="table"
    @cannot('create', App\Models\Kepegawaian\KategoriKualifikasi::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group v-bind="kategori.form.feedback('kode')">
            <b slot="label">Kode:</b>
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="kategori.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group v-bind="kategori.form.feedback('uraian')">
            <b slot="label">Uraian:</b>
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="kategori.form.uraian"
                >
            </input>
        </b-form-group>
        <b-form-group v-bind="kategori.form.feedback('tenaga_medis')">
            <check
                :checked="kategori.form.tenaga_medis"
                v-model="kategori.form.tenaga_medis">
            </check>
            <span style="display: inline-block;position: relative;top:4px">Tenaga Medis</span>
        </b-form-group>
    </div>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            kategori: {
                url   : `{{ action('Kepegawaian\KategoriKualifikasiController@index') }}`,
                sortBy: 'uraian',
                fields: [{
                    key      : 'kode',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                }],
                form: new Form({
                    kode        : null,
                    tenaga_medis: null,
                    uraian      : null
                }),
            }
        }
    },
});
</script>
@endpush
