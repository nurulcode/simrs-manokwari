@extends('layouts.single-card')

@section('title', 'Rawat Jalan Management')

@section('card')
    <data-table v-bind.sync="pelayanan" ref="table" no-action no-add-button-text>
        <template slot="view" slot-scope="{item: pelayanan}">
            <a :href="`{{ action('KunjunganWebController@index') }}/${pelayanan.id}`"
                class="btn btn-primary"> <i class="icon-eye"></i> &nbsp;View
            </a>
        </template>
        <template slot="nomor_kunjungan" slot-scope="{item}">
            @{{ item.kunjungan.nomor_kunjungan }}
        </template>
        <template slot="pasien" slot-scope="{item}">
            @{{ item.kunjungan.pasien.nama }}
            <p class="text-muted">@{{ item.kunjungan.pasien.no_rekam_medis }}</p>
        </template>
        <template slot="nomor_kunjungan" slot-scope="{item}">
            @{{ item.kunjungan.nomor_kunjungan }}
        </template>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            pelayanan: {
                url    : `{{ action('Pelayanan\RawatJalanController@index') }}`,
                options:{
                    sortBy  : 'id',
                    sortDesc: true
                },
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
                    key      : 'waktu_pelayanan',
                    formatter: waktu => format(parse(waktu), 'DD/MM/YYYY H:mm:ss'),
                    sortable : true,
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'keluhan',
                    thStyle  : {
                        'width': '200px'
                    }
                }, {
                    key      : 'view'
                }]
            }
        }
    },
});
</script>
@endpush
