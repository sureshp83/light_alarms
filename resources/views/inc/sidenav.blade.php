<ul class="sidenav_nav">
    <li class="sidenav-item{{ route::is('new-products.index') ? ' sidenav-item--active' : '' }}">
        <a href="{{ route('new-products.index') }}" target="_self"
            class="btn sidenav-item__link btn-link">
            <svg class="icon"><use xlink:href="#icon-star"></use></svg>
            <span class="title">New Products</span>
        </a>
    </li>
    <li class="sidenav-item{{ route::is('built-and-priced.index') ? ' sidenav-item--active' : '' }}">
        <a href="{{ route('built-and-priced.index') }}" target="_self"
            class="btn sidenav-item__link btn-link">
            <svg class="icon"><use xlink:href="#icon-gear"></use></svg>
            <span class="title">Built and Priced</span>
        </a>
    </li>
    <li class="sidenav-item{{ route::is('product-training-videos.index') ? ' sidenav-item--active' : '' }}">
        <a href="{{ route('product-training-videos.index') }}" target="_self"
            class="btn sidenav-item__link btn-link">
            <svg class="icon"><use xlink:href="#icon-book"></use></svg>
            <span class="title">Training Modules</span>
        </a>
    </li>
    <li class="sidenav-item collapsable">
        <b-btn
            href="#marketing_tools_accordion"
            v-b-toggle.marketing_tools_accordion
            class="sidenav-item__link"
            variant="link">
            <svg class="icon"><use xlink:href="#icon-lamp"></use></svg>
            <span class="title">Marketing Tools</span>
            <span class="when-opened"><span class="ml-auto caret caret-up"></span></span>
            <span class="when-closed"><span class="ml-auto caret caret-down"></span></span>
        </b-btn>

        <b-collapse
            id="marketing_tools_accordion"
            is-nav
            visible
            >
            <ul class="sidenav_opened">
                <li class="sidenav-item{{ route::is('marketing.sales-literature.get') ? ' sidenav-item--active' : '' }}">
                    <a href="{{ route('marketing.sales-literature.get') }}" target="_self"
                        class="btn sidenav-item__link btn-link">
                        <span class="title">Sales Literature Request</span>
                    </a>
                </li>
                <li class="sidenav-item{{ route::is('marketing.custom-brochure.get') ? ' sidenav-item--active' : '' }}">
                    <a href="{{ route('marketing.custom-brochure.get') }}" target="_self"
                        class="btn sidenav-item__link btn-link">
                        <span class="title">Custom Brochure Request</span>
                    </a>
                </li>
                <li class="sidenav-item{{ route::is('marketing.display-board.get') ? ' sidenav-item--active' : '' }}">
                    <a href="{{ route('marketing.display-board.get') }}" target="_self"
                        class="btn sidenav-item__link btn-link">
                        <span class="title">Display Board Request</span>
                    </a>
                </li>
            </ul>
        </b-collapse>
    </li>

    <li class="sidenav-item">
        <a rel="noopener" href="https://tnbaccess.tnb.com/sps/tbx" target="_blank" class="btn sidenav-item__link btn-link">
            <svg class="icon"><use xlink:href="#icon-globe"></use></svg>
            <span class="title">T&amp;B Access</span>
        </a>
    </li>
    <li class="sidenav-item{{ Route::is('pages.contact-us') ? ' sidenav-item--active' : '' }}">
        <a href="{{ route('pages.contact-us') }}" target="_self"
            class="btn sidenav-item__link btn-link">
            <svg class="icon"><use xlink:href="#icon-headset"></use></svg>
            <span class="title">Contact Us</span>
        </a>
    </li>
</ul>
