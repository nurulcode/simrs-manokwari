@component('components.card', ['header' => 'Kunjungan Rawat Jalan'])
    @slot('title')
        {{ $rawat_jalan->poliklinik->nama }}
    @endslot
    <b-tabs>
        <b-tab title="first" active>
            <br>I'm the first fading tab
        </b-tab>
        <b-tab title="second" >
            <br>I'm the second tab content
        </b-tab>
        <b-tab title="disabled" disabled>
            <br>Disabled tab!
        </b-tab>
    </b-tabs>
@endcomponent

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

    }
});
</script>
@endpush