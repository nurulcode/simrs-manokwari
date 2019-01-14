@extends('layouts.coreui')

@section('title', 'Tarif Management')

@section('content')
<b-tabs lazy no-fade>
    <b-tab title="Tindakan/Pemeriksaan"> @include('tarif.tindakan') </b-tab>
</b-tabs>

<form-modal ok-title="Simpan" ref="form" :form="form" size="lg">
    <b-form-group label="Ubah Tarif:">
        <input
            class="form-control"
            disabled
            placeholder="Edite"
            type="text"
            :value="edite"
            >
        </input>
    </b-form-group>
    <template v-for="kelas in Object.keys(form.data)">
        <hr>
        <h6>@{{ kelas_tarif[kelas] }}</h6>
        <div class="row">
            <div class="col">
                <b-form-group label="Tarif Sarana:">
                    <input
                        class="form-control"
                        type="number"
                        v-model="form.data[kelas].tarif_sarana"
                        >
                    </input>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Tarif Pelayanan:">
                    <input
                        class="form-control"
                        type="number"
                        v-model="form.data[kelas].tarif_pelayanan"
                        >
                    </input>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Tarif BHP:">
                    <input
                        class="form-control"
                        type="number"
                        v-model="form.data[kelas].tarif_bhp"
                        >
                    </input>
                </b-form-group>
            </div>
        </div>
    </template>
</form-modal>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            form: new Form({
                tarifable_type: null,
                tarifable_id  : null,
                data: {}
            }),
            edite: '',
            kelas_tarif: @json(App\Enums\KelasTarif::toSelectArray())
        }
    },
    methods: {
        setTarif(title, tarif) {
            this.edite = title;
            this.form.assign(tarif);

            this.$refs.form.post(`{{ action('StoreTarifController') }}`)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
});
</script>
@endpush