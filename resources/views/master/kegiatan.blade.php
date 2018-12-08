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
<b-tab title="Kegiatan">
    <template v-if="selected.kategori">
        @component('components.card', ['class' => 'bg-light'])
            @slot('header')
                Kategori Terpilih:
                <div class="card-header-actions">
                    <a v-on:click.prevent="clearKategori"
                        class="card-header-action btn-close"
                        title="close"
                        style="cursor: pointer;"
                        >
                        <i class="icon-close"></i>
                    </a>
                </div>
            @endslot
            <h5>@{{ selected.kategori.uraian }}</h5>
        @endcomponent
    </template>
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
            <b-form-group label="Kategori:" v-bind="kegiatan.form.feedback('kategori')">
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
                kategori: null,
                kegiatan: null
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

                    this.kegiatan.url      = `${item.path}/kegiatan`;

                    let kategori = this.kegiatan.form.kategori || [];

                    kategori.push(item);

                    this.kegiatan.form.setDefault('kategori', kategori);

                    this.selected_tab = 1;
                },
                form: new Form({ uraian: null }),
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
    methods: {
        clearKategori() {
            this.selected.kategori = null;

            this.kegiatan.url = `{{ action('Master\KegiatanController@index') }}`;

            this.kegiatan.form.setDefault('kategori', null);
        }
    }
});
</script>
@endpush
