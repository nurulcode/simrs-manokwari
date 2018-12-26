@extends('layouts.single-card')

@section('title', 'Rawat Jalan Management')

@section('card')
    <data-table v-bind.sync="perawatan" ref="table" no-action v-on:dt:item-create="create">
        <template slot="view" slot-scope="{item}">
            <a :href="`{{ action('Perawatan\RawatJalanWebController@index') }}/${item.id}`"
                class="btn btn-primary"> <i class="icon-eye"></i>
            </a>
        </template>
        <template slot="nomor_kunjungan" slot-scope="{item}">
            @{{ item.kunjungan.nomor_kunjungan }}
        </template>
        <template slot="pasien" slot-scope="{item}">
            @{{ item.kunjungan.pasien.nama }}
            <p class="text-muted">@{{ item.kunjungan.pasien.no_rekam_medis }}</p>
        </template>
        <template slot="diagnosa_awal" slot-scope="{item}">
            @{{ item.kunjungan.penyakit.icd }} -
            @{{ item.kunjungan.penyakit.uraian }}

        </template>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            perawatan: {
                sortBy  : `id`,
                sortDesc: true,
                url     : `{{ action('Perawatan\RawatJalanController@index') }}`,
                fields: [{
                    key      : 'nomor_kunjungan',
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'pasien',
                },{
                    key      : 'poliklinik',
                    formatter: poliklinik => poliklinik.nama,
                },{
                    key      : 'waktu_kunjungan',
                    formatter: waktu => format(parse(waktu), 'DD/MM/YYYY H:mm:ss'),
                    sortable : true,
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'diagnosa_awal',
                    thStyle  : {
                        'width': '200px'
                    }
                }, {
                    key      : 'view',
                    class    : 'text-center',
                    thStyle  : {
                        'width': '80px'
                    }
                }]
            }
        }
    },
    methods: {
        create() {
            window.location.replace(`{{ action('Perawatan\RawatJalanWebController@create') }}`);
        }
    }
});
</script>
@endpush
