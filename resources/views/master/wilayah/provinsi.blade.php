<data-table v-bind.sync="provinsi" ref="table">
    <div slot="form">
        <b-form-group label="Name:" v-bind="provinsi.form.feedback('name')">
            <input
                class="form-control"
                name="name"
                placeholder="Name"
                type="text"
                v-model="provinsi.form.name"
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
            provinsi: {
                sortBy: 'name',
                url   : `{{ action('Master\Wilayah\ProvinsiController@index') }}`,
                fields: [
                    {
                        key     : 'name',
                        sortable: true,
                    },
                ],
                onDoubleClicked: (item, index, event) => {
                    this.selected.provinsi = item;

                    this.kota_kabupaten.url    = `${item.path}/kota-kabupaten`;
                    this.kota_kabupaten.sortBy = `name`;

                    this.kota_kabupaten.form.setDefault('provinsi', item);

                    this.kota_kabupaten.form.setDefault('provinsi_id', item.id);

                    this.selected_tab = 1;
                },
                form: new Form({ name: null }),
            }
        }
    },
});
</script>
@endpush