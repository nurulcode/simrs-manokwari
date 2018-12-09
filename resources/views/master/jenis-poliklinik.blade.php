@extends('layouts.single-card')

@section('title', 'Master Jenis Poliklinik Management')

@section('card')
    <data-table v-bind.sync="jenis_poliklinik" ref="table"
        @cannot('create', App\Models\Master\JenisPoliklinik::class)
            no-add-button-text
        @endcannot
        >
        <div slot="form">
            <b-form-group label="Uraian:" v-bind="jenis_poliklinik.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="jenis_poliklinik.form.uraian"
                    >
                </input>
            </b-form-group>
        </div>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            jenis_poliklinik: {
                url   : `{{ action('Master\JenisPoliklinikController@index') }}`,
                sortBy: 'uraian',
                fields: [{
                    key      : 'uraian',
                    sortable : true,
                }],
                form: new Form({uraian: null}),
            }
        }
    },
});
</script>
@endpush
