<app-sidebar inline-template>
    <div class="sidebar">
        <form class="sidebar-form">

            @component('components.input-group')
                <input class="form-control" placeholder="Search..." type="text" v-model="filter" />
                <span class="input-group-btn">
                    <button class="btn btn-flat" title="Cari menu" v-on:click.prevent="clearfilter">
                        <i v-if="filter" class="fa fa-times"></i>
                        <i v-else class="fa fa-search"></i>
                    </button>

                </span>
            @endcomponent

        </form>
        <nav class="sidebar-nav">
            <ul class="nav">
                <template v-for="(item, index) in filtered">
                    <li v-if="item.is_header" class="nav-title" :key="index" v-html="item.title"></li>

                    <sidebar-nav-item v-else :menu="item" :key="index" :highlight=filter></sidebar-nav-item>

                </template>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button" v-on:click.prevent="minimize"></button>
    </div>
</app-sidebar>

@push('javascripts')
<script>
window.inlines['app-sidebar'] = {
    data() {
        return {
            menunavs  : @json(Sty\Menu::yaml('menu.yaml')),
            filtered  : [],
            filter    : ''
        }
    },
    mounted() {
        this.filtered = this.menunavs;

        this.debounceFilter = debounce(this.filterMenu, 500);
    },
    methods: {
        clearfilter() {
            this.filter = '';
        },
        filterMenu: function (menus, filter) {
            menus  = JSON.parse(JSON.stringify(menus));

            if (!filter) {
                return this.filtered = menus;
            }

            this.filtered = window.filter(menus, (menu) => {
                if (menu.is_header) {
                    return;
                }

                if (menu.childs && menu.childs.length > 0) {

                    menu.childs = this.filterMenu(menu.childs, filter);

                    return menu.childs && menu.childs.length > 0;
                }

                return menu.title.search(new RegExp(filter, 'i')) > -1;
            });
        },
        minimize() {
            document.body.classList.toggle('sidebar-minimized');
            document.body.classList.toggle('brand-minimized');

            document.querySelector('.sidebar-nav section').classList.toggle('ps');

        }
    },
    watch: {
        filter(query) {
            this.debounceFilter(
                this.menunavs,  escapeRegExp(this.filter)
            );
        }
    }
}
</script>
@endpush