@extends('layouts.single-card')

@section('title', 'Role Management')

@section('card')
    <data-table v-bind.sync="role" ref="table">
        <div slot="form">
            <b-form-group label="Name:" v-bind="role.form.feedback('name')">
                <input
                    class="form-control"
                    name="name"
                    placeholder="Name"
                    type="text"
                    v-model="role.form.name"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Description:" v-bind="role.form.feedback('description')">
                <input
                    class="form-control"
                    name="description"
                    placeholder="Description"
                    type="text"
                    v-model="role.form.description"
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
            role: {
                url    : `{{ action('RoleController@index') }}`,
                options: {
                    sortBy: 'name'
                },
                fields: [
                    {
                        key     : 'name',
                        sortable: true,
                    },
                    {
                        key     : 'description',
                    },
                ],
                form: new Form({
                    name       : null,
                    description: null,
                })
            }
        }
    },
});
</script>
@endpush
