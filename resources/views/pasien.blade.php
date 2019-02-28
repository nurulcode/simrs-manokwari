@extends('layouts.single-card')

@section('title', 'Pasien Management')

@section('card')
    <data-table v-bind.sync="pasien" ref="table" modal-size="lg" :form="form_pasien">
        <div slot="before-search">
            <div class="b-form-group form-group">
                <div class="input-group">
                    <input placeholder="Search MR" type="text" class="form-control" v-model='pasien.params.mr'>
                    <div class="input-group-append">
                        <button v-if="!pasien.params.mr" title="Cari..." type="button" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                        <button v-else title="Clear" type="button" class="btn btn-secondary"
                            v-on:click="pasien.params.mr = ''">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
                sortDesc: true,
                params  : {
                    mr: ''
                },
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
