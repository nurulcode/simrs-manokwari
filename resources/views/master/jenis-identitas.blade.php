@extends('layouts.single-card')

@section('title', 'Master Jenis Identitas Management')

@section('card')
    <data-table v-bind.sync="jenis_identitas" ref="table"
        @cannot('create', App\Models\Master\JenisIdentitas::class)
            no-add-button-text
        @endcannot
        >
        <div slot="form">
            <b-form-group label="Uraian:" v-bind="jenis_identitas.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="jenis_identitas.form.uraian"
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
            jenis_identitas: {
                url   : `{{ action('Master\JenisIdentitasController@index') }}`,
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
