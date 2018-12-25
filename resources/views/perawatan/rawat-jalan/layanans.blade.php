<b-card no-body>
    <b-tabs lazy card>
        <b-tab title="Diagnosa" active>
            I'm the first fading tab
        </b-tab>
        <b-tab title="second" >
            <br>I'm the second tab content
        </b-tab>
        <b-tab title="disabled" disabled>
            <br>Disabled tab!
        </b-tab>
    </b-tabs>
</b-card>


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