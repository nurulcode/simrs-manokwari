@extends('layouts.coreui')

@section('content')
    @component('components.card')

        @slot('header') @yield('title') @endslot

        @yield('card')

        @slot('footer') @yield('footer') @endslot

    @endcomponent
@endsection