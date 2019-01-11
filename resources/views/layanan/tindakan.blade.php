<data-table v-bind.sync="tindakan" ref="table_tindakan" title="Tindakan">
    <div slot="form">
        <b-form-group v-bind="tindakan.form.feedback('penyakit_id')">
            <b slot="label">Tindakan/Pemeriksaan:</b>
            <ajax-select
                :params="{poliklinik: {{ $perawatan->poliklinik->id }}}"
                deselect-label=""
                label="uraian"
                placeholder="Pilih Tindakan/Pemeriksaan"
                select-label=""
                url="{{ action('Master\TindakanPemeriksaanController@index') }}"
                v-model="tindakan.form.tindakan_pemeriksaan"
                v-bind:key-value.sync="tindakan.form.tindakan_pemeriksaan_id"
                v-on:select="tindakan.form.errors.clear('tindakan_pemeriksaan_id')"
                >
            </ajax-select>
        </b-form-group>
    </div>

</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            tindakan: {
                url   : `{{ action('Layanan\TindakanController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'tindakan_pemeriksaan',
                },{
                    key      : 'jumlah'
                }, {
                    key      : 'petugas',
                    formatter: petugas => petugas.nama
                }],
                form: new Form({
                    perawatan_id           : @json($perawatan->id),
                    perawatan_type         : @json(get_class($perawatan)),
                    tindakan_pemeriksaan_id: null,
                    waktu                  : new Date()
                }, {
                    petugas                : null,
                    tindakan_pemeriksaan   : null
                }),
            }
        }
    },
});
</script>
@endpush