@extends('layouts.coreui')

@section('content')
    @component('components.card')

        @slot('header') @yield('title') @endslot

        @yield('card')

    @endcomponent
@endsection