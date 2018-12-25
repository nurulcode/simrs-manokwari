@extends('layouts.single-card')

@section('title', 'Kunjungan Management')

@section('card')
    <data-table v-bind.sync="kunjungan" ref="table" no-action no-add-button-text>
        <template slot="view" slot-scope="{item: kunjungan}">
            <a :href="`{{ action('KunjunganWebController@index') }}/${kunjungan.id}`"
                class="btn btn-primary"> <i class="icon-eye"></i>
            </a>
        </template>
        <template slot="pasien" slot-scope="{value}">
            @{{ value.nama }}
            <p class="text-muted">@{{ value.no_rekam_medis }}</p>
        </template>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            kunjungan: {
                url    : `{{ action('KunjunganController@index') }}`,
                options:{
                    sortBy  : 'waktu_kunjungan',
                    sortDesc: true
                },
                fields: [{
                    key      : 'nomor_kunjungan',
                    sortable : true,
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'pasien',
                },{
                    key      : 'waktu_kunjungan',
                    formatter: waktu => format(parse(waktu), 'DD/MM/YYYY H:mm:ss'),
                    sortable : true,
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'penyakit',
                    label    : 'Diagnosa Awal',
                    formatter: penyakit => `${penyakit.icd} - ${penyakit.uraian}`,
                    thStyle  : {
                        'width': '200px'
                    }
                },{
                    key      : 'keluhan',
                    thStyle  : {
                        'width': '200px'
                    }
                }, {
                    key      : 'view',
                    class    : 'text-center'
                }]
            }
        }
    },
});
</script>
@endpush
