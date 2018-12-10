<data-table v-bind.sync="kamar" ref="table"
    @cannot('create', App\Models\Fasilitas\Kamar::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group label="Poliklinik:" v-bind="kamar.form.feedback('poliklinik_id')">
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Poliklinik"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="kamar.form.poliklinik"
                v-bind:key-value.sync="kamar.form.poliklinik_id"
                v-on:select="kamar.form.errors.clear('poliklinik_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Ruangan:" v-bind="kamar.form.feedback('ruangan_id')">
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Ruangan"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="kamar.form.ruangan"
                v-bind:key-value.sync="kamar.form.ruangan_id"
                v-on:select="kamar.form.errors.clear('ruangan_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Nama:" v-bind="kamar.form.feedback('nama')">
            <input
                class="form-control"
                name="nama"
                placeholder="Nama"
                type="text"
                v-model="kamar.form.nama"
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
            kamar: {
                sortBy: `nama_ruangan`,
                url   : `{{ action('Fasilitas\KamarController@index') }}`,
                dataMap(item) {
                    return {
                        poliklinik   : item.ruangan.poliklinik,
                        poliklinik_id: item.ruangan.poliklinik_id,
                        ...item
                    }
                },
                fields: [{
                    key       : 'poliklinik',
                    formatter : poliklinik => poliklinik.nama,
                },{
                    key       : 'nama_ruangan',
                    sortable  : true,
                },{
                    key       : 'nama',
                    sortable  : true,
                }],
                form: new Form({
                    poliklinik_id: null,
                    ruangan_id   : null,
                    nama         : null,
                }, {
                    poliklinik   : null,
                    ruangan      : null,
                }),
            }
        }
    },
});
</script>
@endpush