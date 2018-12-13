@extends('layouts.single-card')

@section('title', 'Master Daftar Pekerjaan Management')

@section('card')
    <data-table v-bind.sync="resource" ref="table"
        @cannot('create', App\Models\Master\Pekerjaan::class)
            no-add-button-text
        @endcannot
        >
        <div slot="form">
            <b-form-group label="Uraian:" v-bind="resource.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="resource.form.uraian"
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
            resource: {
                url   : `{{ action('Master\PekerjaanController@index') }}`,
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
