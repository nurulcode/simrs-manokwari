@extends('layouts.tabs')

@section('title', 'Master Wilayah Management')

@section('tabs')
<b-tab title="Provinsi">
    <data-table v-bind.sync="provinsi" ref="table">
        <div slot="form">
            <b-form-group label="Name:" v-bind="provinsi.form.feedback('name')">
                <input
                    class="form-control"
                    name="name"
                    placeholder="Name"
                    type="text"
                    v-model="provinsi.form.name"
                    >
                </input>
            </b-form-group>
        </div>
    </data-table>
</b-tab>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            provinsi: {
                url    : `{{ action('Master\Wilayah\ProvinsiController@index') }}`,
                options: {
                    sortBy: 'name'
                },
                fields: [
                    {
                        key     : 'name',
                        sortable: true,
                    },
                ],
                form: new Form({ name: null })
            }
        }
    },
});
</script>
@endpush
