@extends('layouts.base')

@section('body-class', 'header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show')

@push('plugins-css')
    <link rel="stylesheet" href="{{ asset(mix('css/icon-fonts/simple-line-icons.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/icon-fonts/font-awesome.css')) }}">
@endpush

@section('app')
    @include('shared.app-header')

    <div class="app-body">
        @include('shared.app-sidebar')

        <main class="main">
            @include('shared.breadcrumb')

            <div class="container-fluid"> @yield('content') </div>
        </main>
    </div>

    @include('shared.app-footer')

    @includeWhen(Auth::check(), 'shared.changepassmodal')
@endsection