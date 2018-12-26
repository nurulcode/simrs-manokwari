@extends('layouts.single-card')

@section('title', 'Pasien Management')

@section('card')
    <data-table v-bind.sync="pasien" ref="table" modal-size="lg" :form="form_pasien"
        @cannot('create', App\Models\Pasien::class)
            no-add-button-text
        @endcannot>
        <div slot="form"> @include('pasien-form') </div>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            pasien: {
                sortBy  : `no_rekam_medis`,
                sortDesc: true
                url     : `{{ action('PasienController@index') }}`,
                fields: [{
                    key      : 'no_rekam_medis',
                    sortable : true,
                },{
                    key      : 'nama',
                    sortable : true,
                },{
                    key      : 'nomor_identitas',
                },{
                    key      : 'tanggal_lahir',
                    formatter: value => format(parse(value), 'DD/MM/YYYY')
                },{
                    key      : 'tanggal_registrasi',
                    formatter: value => format(parse(value), 'DD/MM/YYYY HH:mm'),
                    sortable : true,
                }]
            },
        }
    },
});
</script>
@endpush
