@extends('layouts.tabs')

@section('title', 'Master Kegiatan Management')

@section('tabs')

<b-tab title="Klasifikasi Penyakit">
    <data-table v-bind.sync="klasifikasi" ref="table">
        <div slot="form">
            <b-form-group label="Kode:" v-bind="klasifikasi.form.feedback('kode')">
                <input
                    class="form-control"
                    name="kode"
                    placeholder="Kode"
                    type="text"
                    v-model="klasifikasi.form.kode"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Uraian:" v-bind="klasifikasi.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="klasifikasi.form.uraian"
                    >
                </input>
            </b-form-group>
        </div>
    </data-table>
</b-tab>
<b-tab title="Kegiatan">
    <data-table v-bind.sync="kegiatan" ref="table">
        <div slot="form">
            <b-form-group label="Uraian:" v-bind="kegiatan.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="kegiatan.form.uraian"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Kelompok Kegiatan:" v-bind="kegiatan.form.feedback('parent_id')">
                <ajax-select
                    :url="kegiatan.url"
                    label="uraian"
                    placeholder="Pilih Kelompok Kegiatan"
                    v-model="kegiatan.form.parent"
                    v-bind:key-value.sync="kegiatan.form.parent_id"
                    v-on:change="kegiatan.form.errors.clear('parent_id')"
                    >
                </ajax-select>
            </b-form-group>
            <b-form-group label="Roles:" v-bind="kegiatan.form.feedback('kategori')">
                <ajax-select
                    :multiple="true"
                    url="{{ action('Master\KategoriKegiatanController@index') }}"
                    label="uraian"
                    placeholder="Pilih Kategori"
                    v-model="kegiatan.form.kategori"
                    >
                </ajax-select>
            </b-form-group>
            <b-form-group
                horizontal
                :label="`Kode ${kat.uraian}:`"
                :key="key"
                :label-cols="6"
                v-bind="kegiatan.form.feedback(`kategori.${key}.kode`)"
                v-for="(kat, key) in kegiatan.form.kategori"
                >
                <b-form-input
                    :name="`kategori.${key}.kode`"
                    :placeholder="`Kode ${kat.uraian}:`"
                    v-model="kegiatan.form.kategori[key].kode"
                    >
                </b-form-input>
            </b-form-group>
        </div>
        <template slot="uraian" slot-scope="{item}">
            @{{ item.uraian }}
            <span class="text-muted" v-if="item.parent">&nbsp;- @{{ item.parent.uraian }}</span>
            <p>
                <b-badge
                    v-for="kat in item.kategori"
                    class="mr-1"
                    variant="success"
                    v-bind:key="kat.pivot_id"
                    v-text="`${kat.kode} : ${kat.uraian}`"
                    >
                </b-badge>
            </p>
        </template>
    </data-table>
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected: {
                klasifikasi      : null,
            },
            klasifikasi: {
                sortBy: 'kode',
                url   : `{{ action('Master\Penyakit\KlasifikasiPenyakitController@index') }}`,
                fields: [
                    {
                        key     : 'kode',
                        sortable: true,
                    },
                    {
                        key     : 'uraian',
                        sortable: true,
                    },
                ],
                onDoubleClicked: (item, index, event) => {
                    this.selected.klasifikasi = item;

                    // this.kota_kabupaten.url    = `${item.path}/kota-kabupaten`;
                    // this.kota_kabupaten.sortBy = `name`;

                    // this.kota_kabupaten.form.setDefault('provinsi', item);

                    // this.kota_kabupaten.form.setDefault('provinsi_id', item.id);

                    // this.selected_tab = 1;
                },
                form: new Form({
                    kode  : null,
                    uraian: null
                }),
            },
            kegiatan: {
                sortBy: 'uraian',
                url   : `{{ action('Master\KegiatanController@index') }}`,
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
                form: new Form(
                    {
                        uraian   : null,
                        kategori : null,
                        parent_id: null
                    },
                    {
                        parent   : null
                    }
                ),
            }
        }
    },
});
</script>
@endpush
