@extends('layouts.coreui')

@section('title', 'Tarif Management')

@section('content')
<b-tabs lazy no-fade>
    <b-tab title="Registrasi"> @include('tarif.registrasi') </b-tab>
    <b-tab title="Ruangan"> @include('tarif.ruangan') </b-tab>
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
    <template v-for="kelas in Object.keys(form.tarif)">
        <hr>
        <h6>@{{ kelas_tarif[kelas] }}</h6>
        <div class="row">
            @foreach (App\Enums\JenisTarif::getValues() as $kelas)
                <div class="col">
                    <b-form-group label="{{ App\Enums\JenisTarif::getDescription($kelas) }}:">
                        <input
                            class="form-control"
                            type="number"
                            v-model="form.tarif[kelas].{{ $kelas }}"
                            >
                        </input>
                    </b-form-group>
                </div>
            @endforeach
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
                tarif: {}
            }),
            edite: '',
            kelas_tarif: @json(App\Enums\KelasTarif::keyDescriptions())
        }
    },
    methods: {
        setTarif(title, tarif, table) {
            this.edite = title;

            this.form.assign(tarif);

            this.$refs.form.post(`{{ action('StoreTarifController') }}`)
                .then(response => {
                    window.flash(response.data.message, response.data.status);

                    this.$refs[table].refresh();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
});
</script>
@endpush