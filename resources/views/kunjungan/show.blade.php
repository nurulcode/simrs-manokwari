@extends('layouts.coreui')

@section('title', 'Pasien Rawat Jalan')

@section('content')

    @include('kunjungan.banner', ['title' => $kunjungan->pasien->nama])

    @component('components.card', ['header' => 'Kunjungan'])

    <form
        action="{{ $kunjungan->path }}"
        id="form_kunjungan"
        method="POST"
        v-on:submit.prevent="submit"
        v-on:keydown="e => form_kunjungan.errors.clear(e.target.name)">

        @include('kunjungan.form')
    </form>

    <loading-overlay v-show="form_kunjungan.is_loading"></loading-overlay>

    @slot('footer')

        <button form="form_kunjungan" type="submit" class="btn btn-primary"> Simpan </button>

    @endslot

    @endcomponent

@endsection

@push('javascripts')

<script>
window.pagemix.push({
    data() {
        return {
            form_kunjungan: new Form({
                _method            : 'PUT',
                nomor_kunjungan    : @json($kunjungan->nomor_kunjungan),
                rujukan            : @json($kunjungan->rujukan),
                waktu_kunjungan    : @json($kunjungan->waktu_kunjungan),
                cara_pembayaran_id : @json($kunjungan->cara_pembayaran_id),
                sjp_nomor          : null,
                sjp_tanggal        : null,
                pj_nama            : null,
                pj_telepon         : null,
                kasus_id           : null,
                pasien_id          : null,
                penyakit_id        : null,
                tarif_registrasi_id: null,
                poliklinik_id      : null,
                kegiatan_id        : null,
            },{
                pasien             : @json($kunjungan->pasien),
                jenis_rujukan      : null,
                kasus              : null,
                penyakit           : null,
                jenis_registrasi   : null,
                poliklinik         : null,
                kegiatan           : null
            })
        }
    },
    methods: {
        submit(e) {
            this[e.target.id].post(e.target.action)
                .then(response => {
                    if (response.data.message && response.data.status) {
                        window.flash(response.data.message, response.data.status);
                    }

                    this.form_kunjungan.assign(response.data.data);
                })
                .catch(error => {
                    //
                });

        }
    },
    mounted() {
        this.form_kunjungan.assign(@json($kunjungan))
    }
});
</script>

@endpush