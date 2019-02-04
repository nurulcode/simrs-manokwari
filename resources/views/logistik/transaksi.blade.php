<data-table v-bind.sync="transaksi" ref="table" no-action>

</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            transaksi: {
                url   : `{{ action('Logistik\TransaksiController@index') }}`,
                fields: [{
                    key      : 'jenis_transaksi',
                    formatter: jenis => jenis ? jenis : 'Koreksi'
                },{
                    key      : 'logistik',
                    formatter: logistik => logistik ? logistik.uraian : ''
                }, {
                    key      : 'apotek',
                    formatter: apotek => apotek ? apotek.nama : ''
                }, {
                    key      : 'jumlah',
                }],
            }
        }
    },
});
</script>
@endpush
