<data-table v-bind.sync="kategori" ref="table"
    @cannot('create', App\Models\Kepegawaian\KategoriKualifikasi::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group label="Uraian:" v-bind="kategori.form.feedback('uraian')">
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="kategori.form.uraian"
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
            kategori: {
                url   : `{{ action('Kepegawaian\KategoriKualifikasiController@index') }}`,
                sortBy: 'uraian',
                fields: [{
                    key      : 'uraian',
                    sortable : true,
                }],
                form: new Form({uraian: null}),
            }
        }
    },
});
</script>
@endpush
