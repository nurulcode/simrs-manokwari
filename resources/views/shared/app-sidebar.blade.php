<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @each('shared.nav-item', App\Menu::all(), 'menu')
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>