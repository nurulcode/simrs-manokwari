<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">
        <img src="{{ asset('/images/logo-image.png') }}" height="24" style="margin-top: -4px">
        <h3 class="navbar-brand-full ml-2 mb-1">HRDSPL</h3>
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    @include('shared.navbar')
</header>