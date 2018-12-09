@extends('layouts.single-card')

@section('title', 'Permission Management')

@section('card')
    <data-table v-bind.sync="activities" ref="table" no-action no-add-button-text>

    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            activities: {
                url    : `{{ action('ActivityController@index') }}`,
                options: {
                    sortBy  : 'created_at',
                    sortDesc: true
                },
                fields: [
                    {
                        key      : 'user',
                        formatter: user => user.name
                    },
                    {
                        key      : 'type',
                    },
                    {
                        label    : 'Waktu',
                        key      : 'created_at',
                        sortable : true
                    },
                ],
            }
        }
    },
});
</script>
@endpush
