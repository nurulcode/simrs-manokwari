@extends('layouts.single-card')

@section('title', 'User Management')

@section('card')
    <data-table v-bind.sync="user" ref="table">
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
            <b-form-group label="Username:" v-bind="user.form.feedback('username')">
                <input
                    class="form-control"
                    name="username"
                    placeholder="Username"
                    type="text"
                    v-model="user.form.username"
                    >
                </input>
            </b-form-group>
            {{-- <b-form-group label="Roles:" v-bind="user.form.feedback('roles')">
                <ajax-select
                    :url="`${route('authorization.role.index')}`"
                    :multiple="true"
                    label="description"
                    placeholder="Pilih Roles"
                    v-model="user.form.roles"
                    >
                </ajax-select>
            </b-form-group> --}}
            <hr>
            <b-form-group label="Password:" v-bind="user.form.feedback('password')">
                <input
                    class="form-control"
                    name="password"
                    placeholder="Password"
                    type="password"
                    v-model="user.form.password"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Konfirmasi Password:"
                v-bind="user.form.feedback('password_confirmation')">
                <input
                    class="form-control"
                    name="password_confirmation"
                    placeholder="Konfirmasi Password"
                    type="password"
                    v-model="user.form.password_confirmation"
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
            user: {
                url    : `{{ route('user.index') }}`,
                options: {
                    sortBy: 'username'
                },
                fields: [
                    {
                        key     : 'name',
                        sortable: true,
                    },
                    {
                        key     : 'username',
                        sortable: true,
                    },
                    {
                        key     : 'last_login',
                        sortable: true,
                    },
                    {
                        key  : 'active',
                        class: 'text-center'
                    }
                ],
                form: new Form({
                    active  : true,
                    username: null,
                    password: null,
                    password_confirmation: null,
                    roles   : [],
                })
            }
        }
    },
    methods: {
        toggle(item) {
            this.user.form.assign(Object.assign(item, {
                active: !item.active
            })).put(item.path)
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
