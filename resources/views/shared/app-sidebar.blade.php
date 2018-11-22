<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @each('shared.nav-item', Sty\Menu::yaml('menu.yaml'), 'menu')
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>