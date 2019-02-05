@extends('layouts.single-card')

@section('title', 'Apotek Pasien Perawatan')

@section('card')
    <data-table v-bind.sync="apotek" ref="table" no-action no-add-button-text>
        <template slot="view" slot-scope="{item}">
            <a :href="`{{ url()->current() }}/${item.id}`"
                class="btn btn-primary"> <i class="icon-eye"></i>
            </a>
        </template>
        <template slot="waktu_masuk" slot-scope="{value}" v-if="value">
            @{{ value | date_time }}
        </template>

    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            apotek: {
                sortBy  : `waktu_masuk`,
                sortDesc: true,
                url     : `{{ action('KunjunganController@index') }}`,

                fields: [{
                    key      : 'nomor_kunjungan',
                    thStyle  : {
                        'width': '160px'
                    }
                },{
                    key      : 'pasien',
                    thStyle  : {
                        'min-width': '160px'
                    }
                },{
                    key      : 'waktu_masuk',
                    sortable : true,
                    thStyle  : {
                        'width': '180px'
                    }
                },{
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

    }
});
</script>
@endpush
