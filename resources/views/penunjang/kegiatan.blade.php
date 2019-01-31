<data-table v-bind.sync="tindakan" ref="table_tindakan" title="Tindakan" no-edit
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <b-form-group v-bind="tindakan.form.feedback('tindakan_id')">
            <b slot="label">Tindakan/Pemeriksaan:</b>
            <ajax-select
                :params="{kategori: {{ $kategori }}}"
                deselect-label=""
                label="uraian"
                placeholder="Pilih Tindakan/Pemeriksaan"
                select-label=""
                url="{{ action('Master\KegiatanController@index') }}"
                v-model="tindakan.form.tindakan"
                v-bind:key-value.sync="tindakan.form.tindakan_id"
                v-on:select="tindakan.form.errors.clear('tindakan_id')"
                >

            </ajax-select>
        </b-form-group>
        <b-form-group label="Catatan:" v-bind="tindakan.form.feedback('catatan')">
            <textarea class="form-control" name="catatan" v-model="tindakan.form.catatan">

            </textarea>
        </b-form-group>
        <b-form-group v-bind="tindakan.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="tindakan.form.petugas"
                v-bind:key-value.sync="tindakan.form.petugas_id"
                v-on:select="tindakan.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="tindakan.form.feedback('waktu')">
            <b slot="label">Waktu Tindakan:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="tindakan.form.waktu"
                v-on:input="tindakan.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="tindakan" slot-scope="{value}" v-if="value">
        @{{ value.uraian }}
    </template>
    <template slot="tarif_sarana" slot-scope="{item}">
        @{{ item.tarif && item.tarif.SARANA }}
    </template>
    <template slot="tarif_pelayanan" slot-scope="{item}">
        @{{ item.tarif && item.tarif.PELAYANAN }}
    </template>
    <template slot="tarif_bhp" slot-scope="{item}">
        @{{ item.tarif && item.tarif.BHP }}
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            tindakan: {
                url   : `{{ action('Layanan\PenunjangTindakanController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu Pemeriksaan',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'tindakan',
                },{
                    key      : 'tarif_sarana',
                },{
                    key      : 'tarif_pelayanan',
                },{
                    key      : 'tarif_bhp',
                    label    : 'Tarif BHP'
                },{
                    key      : 'petugas',
                    formatter: petugas => petugas && petugas.nama
                }],
                form: new Form({
                    penunjang_id  : @json($penunjang->id),
                    tindakan_id   : null,
                    tindakan_type : 'App\\Models\\Master\\Kegiatan',
                    catatan       : null,
                    petugas_id    : null,
                    waktu         : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    petugas       : null,
                    tindakan      : null
                }),
            }
        }
    },
});
</script>
@endpush