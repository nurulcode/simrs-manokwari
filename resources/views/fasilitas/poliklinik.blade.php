<data-table v-bind.sync="poliklinik" ref="table"
    @cannot('create', App\Models\Fasilitas\Poliklinik::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group label="Kode:" v-bind="poliklinik.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="poliklinik.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group label="Nama:" v-bind="poliklinik.form.feedback('nama')">
            <input
                class="form-control"
                name="nama"
                placeholder="Nama"
                type="text"
                v-model="poliklinik.form.nama"
                >
            </input>
        </b-form-group>
        <b-form-group label="Jenis:" v-bind="poliklinik.form.feedback('jenis')">
            <input
                class="form-control"
                name="jenis"
                placeholder="Jenis"
                type="text"
                v-model="poliklinik.form.jenis"
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
            poliklinik: {
                sortBy: 'kode',
                url   : `{{ action('Fasilitas\PoliklinikController@index') }}`,
                fields: [{
                    key      : 'kode',
                    sortable : true,
                    formatter: item => item.toUpperCase()
                },{
                    key      : 'nama',
                    sortable : true,
                }, {
                    key      : 'jenis',
                }],
                form: new Form({
                    kode : null,
                    nama : null,
                    jenis: null,
                }),
            }
        }
    },
});
</script>
@endpush