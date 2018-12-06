@extends('layouts.tabs')

@section('title', 'Master Kegiatan Management')

@section('tabs')

<b-tab title="Kategori Kegiatan">
    <data-table v-bind.sync="kategori" ref="table">
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
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected: {
                kategori      : null,
            },
            kategori: {
                sortBy: 'uraian',
                url   : `{{ action('Master\KategoriKegiatanController@index') }}`,
                fields: [
                    {
                        key     : 'uraian',
                        sortable: true,
                    },
                ],
                onDoubleClicked: (item, index, event) => {
                    this.selected.kategori = item;

                    // this.kota_kabupaten.url    = `${item.path}/kota-kabupaten`;
                    // this.kota_kabupaten.sortBy = `name`;

                    // this.kota_kabupaten.form.setDefault('provinsi', item);

                    // this.kota_kabupaten.form.setDefault('provinsi_id', item.id);

                    // this.selected_tab = 1;
                },
                form: new Form({ uraian: null }),
            }
        }
    },
});
</script>
@endpush
