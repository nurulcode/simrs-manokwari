<ul class="nav navbar-nav ml-auto">
    <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#">
            <i class="icon-list"></i>
            <span class="badge badge-pill badge-danger">5</span>
        </a>
    </li>
    @includeWhen(Auth::check(), 'shared.userdropdown')
</ul>