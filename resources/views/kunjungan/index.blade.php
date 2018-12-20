@extends('layouts.single-card')

@section('title', 'Kunjungan Management')

@section('card')
    <data-table v-bind.sync="kunjungan" ref="table" no-action no-add-button-text>
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
                url   : `{{ action('KunjunganController@index') }}`,
                sortBy: 'created_at',
                fields: [{
                    key      : 'nomor_kunjungan',
                    sortable : true,
                },{
                    key      : 'pasien',
                },{
                    key      : 'waktu_kunjungan',
                    formatter: waktu => format(parse(waktu), 'DD/MM/YYYY H:mm:ss')
                },{
                    key      : 'keluhan',
                    thStyle  : {
                        'width': '400px'
                    }
                }]
            }
        }
    },
});
</script>
@endpush
