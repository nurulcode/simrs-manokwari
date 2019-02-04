@extends('layouts.tabs')

@section('title', 'Logistik Management')

@section('tabs')

<b-tab title="Stock">
    <data-table v-bind.sync="stock" ref="table_stock" no-action>

        <template slot="jenis" slot-scope="{item, value}" v-if="value">
            @{{ value.uraian }}
        </template>
        <template slot="uraian" slot-scope="{item, value}">
            @{{ value }}
            <p class="text-muted" v-if="item.golongan"> @{{ golongan[item.golongan] }} </p>
        </template>
        <div slot="before-top-button" class="mr-3" style="width: 240px">
            <ajax-select
                :params="{jenis: 11}"
                deselect-label=""
                label="nama"
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                select-label=""
                placeholder="Total Stock"
                v-bind:key-value.sync="stock.params.stock"
                v-model="stock.poli"
                >
            </ajax-select>
        </div>
        <template slot-scope="{item}" slot="action">
            <button class="btn btn-primary" v-on:click="editStock(item)">
                <i class="fa fa-pencil"></i>
            </button>
            <button
                class="btn btn-success"
                {{-- v-on:click="setTarif(item.uraian, item.tarif, 'table_insenerator')"> --}}
                >
                <i class="fa fa-exchange"></i>
            </button>
        </template>
    </data-table>

    <form-modal ok-title="Simpan" ref="form" :form="stock.form" size="lg" title="Ubah Stock">
        <div class="row">
            <div class="col">
                <b-form-group label="Logistik:">
                    <input
                        class="form-control"
                        disabled
                        placeholder="Logistik"
                        type="text"
                        :value="stock.form.logistik && stock.form.logistik.uraian"
                        >
                    </input>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Apotek/Gudang:">
                    <input
                        class="form-control"
                        disabled
                        placeholder="Apotek/Gudang"
                        type="text"
                        :value="stock.form.apotek"
                        >
                    </input>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Stock:">
                    <input
                        class="form-control"
                        placeholder="Stock"
                        type="number"
                        v-model="stock.form.stock"
                        >
                    </input>
                </b-form-group>
            </div>
        </div>


    </form-modal>
</b-tab>
<b-tab title="Transaksi"> @include('logistik.transaksi')</b-tab>
@endsection


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            golongan: @json(App\Enums\GolonganObat::toSelectArray()),
            stock: {
                url   : `{{ action('Logistik\StockLogistikController@index') }}`,
                sortBy: 'jenis',
                params: {
                    jenis: null,
                    stock: '',
                },
                poli  : null,
                fields: [{
                    key      : 'jenis',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                }, {
                    key      : 'satuan',
                }, {
                    key      : 'apotek',
                    label    : 'Gudang/Apotek',
                },{
                    key      : 'stock',
                    thClass  : 'text-center'
                }, {
                    key      : 'action',
                    label    : 'Koreksi Stock'
                }],
                form: new Form({
                    apotek_id  : null,
                    logistik_id: null,
                    stock      : null,
                }, {
                    apotek     : null,
                    logistik   : null
                }),
            }
        }
    },
    methods: {
        editStock(value) {
            this.stock.form.assign({
                apotek_id  : value.apotek_id,
                apotek     : value.apotek,
                logistik_id: value.id,
                logistik   : value,
                stock      : value.stock,
            });

            this.$refs.form.post(`{{ action('Logistik\\StockLogistikController@update') }}`)
                .then(response => {
                    window.flash(response.data.message, response.data.status);

                    this.$refs.table_stock.refresh();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
});
</script>
@endpush
