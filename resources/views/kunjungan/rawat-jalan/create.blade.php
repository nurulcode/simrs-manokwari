<?php
use App\Enums\KategoriRegistrasi;
use App\Models\Fasilitas\Poliklinik;
use App\Models\Master\JenisRegistrasi;
?>

@extends('kunjungan.form-kunjungan')

@section('action', action('RawatJalanController@store'))

@section('form')
<hr>
<div class="row">
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('jenis_registrasi_id')">
            <b slot="label">Jenis Registrasi:</b>
            <b-form-select v-model="form_kunjungan.jenis_registrasi_id"
                v-on:change="form_kunjungan.errors.clear('jenis_registrasi_id')">
                <option :value="null" disabled>Pilih Jenis Registrasi</option>
                @foreach(JenisRegistrasi::where('kategori', KategoriRegistrasi::RAWAT_JALAN)->get() as $registrasi)
                    <option :value="{{ $registrasi->id }}">{{ $registrasi->uraian }}</option>
                @endforeach
            </b-form-select>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('poliklinik_id')">
            <b slot="label">Poliklinik Tujuan:</b>
            <b-form-select v-model="form_kunjungan.poliklinik_id"
                v-on:change="form_kunjungan.errors.clear('poliklinik_id')">
                <option :value="null" disabled>Pilih Poliklinik Tujuan</option>
                @foreach(Poliklinik::where('jenis_id', 1)->get() as $poliklinik)
                    <option :value="{{ $poliklinik->id }}">{{ $poliklinik->nama }}</option>
                @endforeach
            </b-form-select>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('kegiatan_id')">
            <b slot="label">Jenis Kegiatan:</b>
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Jenis Kegiatan"
                select-label=""
                url="{{ action('Master\KegiatanKategoriKegiatanController', 2) }}"
                v-model="form_kunjungan.kegiatan"
                v-bind:key-value.sync="form_kunjungan.kegiatan_id"
                v-on:select="form_kunjungan.errors.clear('kegiatan_id')"
                >
            </ajax-select>
        </b-form-group>
    </div>
</div>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            form_kunjungan: new Form({
                pasien_baru        : false,
                pasien_id          : null,
                nomor_kunjungan    : null,
                rujukan: {
                    jenis_id       : null,
                    asal           : null,
                    nomor          : null,
                    tanggal        : null
                },
                waktu_kunjungan    : null,
                cara_pembayaran_id : null,
                sjp_nomor          : null,
                sjp_tanggal        : null,
                pj_nama            : null,
                pj_telepon         : null,
                kasus_id           : null,
                penyakit_id        : null,
                keluhan            : null,
                jenis_registrasi_id: null,
                poliklinik_id      : null,
                kegiatan_id        : null
            },{
                pasien             : null,
                jenis_rujukan      : null,
                kasus              : null,
                penyakit           : null,
                jenis_registrasi   : null,
                poliklinik         : null,
                kegiatan           : null
            })
        }
    },
    computed: {
        pasien() {
            return this.form_kunjungan.pasien ? this.form_kunjungan.pasien : {
                no_rekam_medis : null,
                nomor_identitas: null,
                jenis_identitas: null,
                tempat_lahir   : null,
                tanggal_lahir  : null,
                alamat         : null,
                telepon        : null
            };
        },
        jenis_identitas() {
            return this.pasien.jenis_identitas ? `(${this.pasien.jenis_identitas.uraian})` : '';
        },
        tempat_tanggal_lahir() {
            if (!this.pasien.tempat_lahir) {
                return this.tanggal_lahir;
            }

            return `${this.pasien.tempat_lahir || ''}, ${this.tanggal_lahir}`
        },
        tanggal_lahir() {
            if (!this.pasien.tanggal_lahir) {
                return '';
            }

            return `${format(parse(this.pasien.tanggal_lahir), 'DD MMMM YYYY')}`;
        }
    },
    methods: {
        now() {
            return new Date
        },
        submit(e) {
            this.form_kunjungan.post(e.target.action)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    //
                });
        }
    }
});
</script>
@endpush