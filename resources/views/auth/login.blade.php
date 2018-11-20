@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<login-card inline-template>
    <div class="card-group">
        <b-card class="p-4" title="{{ __('Login') }}" title-tag="h1">
            <p class="text-muted">Sign In to your account</p>

            <form v-on:keyup.enter="submit" v-on:submit.prevent="submit">
                <b-form-group v-bind="form.feedback('username')">
                    <b-input-group>
                        <input
                            class="form-control"
                            name="username"
                            placeholder="{{ __('Username') }}"
                            tabindex=1
                            v-model="form.username">
                        </input>
                        <b-input-group-append>
                            <button class="btn btn-secondary">
                                <i class="icon-user"></i>
                            </button>
                        </b-input-group-append>

                    </b-input-group>
                </b-form-group>

                <b-form-group v-bind="form.feedback('password')">
                    <b-input-group>
                        <input
                            :type="show_password ? `text`: `password`"
                            class="form-control"
                            name="password"
                            placeholder="{{ __('Password') }}"
                            tabindex=2
                            v-model="form.password">
                        </input>
                        <b-input-group-append>
                            <button class="btn btn-secondary" v-on:click.prevent="show_password = !show_password">
                                <i :class="show_password ? `icon-lock` : `icon-eye`"></i>
                            </button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </form>

            <button class="px-4 btn btn-primary" v-on:click.prevent="submit">
                {{ __('Login') }}
            </button>

            <loading-overlay v-show="submiting"></loading-overlay>
        </b-card>
        <b-card class="text-white bg-primary py-5 d-md-down-none">
            <div class="text-center">
                <p>
                    <img src="{{ url('/images/logo.svg') }}" height="100px" alt="Logo" title="Logo"/>
                </p>
                <h4> Sistem Informasi</h4>
            </div>
        </b-card>
    </div>
</login-card>
@endsection

@push('javascripts')
<script>
window.inlines['login-card'] = {
    data() {
        return {
            alert        : {
                dismissible: true,
                message    : null,
                show       : false,
                variant    : null
            },
            show_password: false,
            submiting    : false,
            form: new Form({
                username: '',
                password: ''
            })
        }
    },
    methods: {
        submit() {
            this.submiting = true;

            this.form.post(`{{ route('login') }}`)
                .then(this.redirect)
                .catch(this.onError);
        },
        redirect(response) {
            window.location.replace(response.request.responseURL);
        },
        onError(error) {
            this.submiting = false;

            if (error.response.status == 419) {
                return stickAlert('419 Authentication Timeout: Refresh Page');
            }
        },
    }
}
</script>
@endpush
