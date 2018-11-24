@extends('layouts.single-card')

@section('title', 'Role Management')

@section('card')
    <data-table v-bind.sync="role" ref="table">
        <template slot='active' slot-scope="{item}">
            <button
                title="Active"
                type="button"
                class="btn btn-primary"
                v-if="item.active"
                v-on:click.prevent="toggle(item)"
                >
                <i class="fa fa-check"></i>
            </button>
            <button
                class="btn btn-danger"
                title="Inactive"
                v-else
                v-on:click="toggle(item)"
                >
                <i class="fa fa-times"></i>
            </button>
        </template>
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
    methods: {
        toggle(item) {
            axios.put(`${item.path}/toggle`)
                .then(response => {
                    this.$refs.table.refresh();
                }).catch(error => {
                    this.$refs.table.refresh();
                });
        }
    }
});
</script>
@endpush
