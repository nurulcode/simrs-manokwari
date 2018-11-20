@extends('layouts.coreui')

@section('content')
<div class="card">
    <div class="card-header">@yield('title')</div>
    <div class="card-body">  @yield('card') </div>
</div>
@endsection