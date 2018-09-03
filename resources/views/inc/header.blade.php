<b-navbar
    toggleable="lg"
    variant="default"
    class="navbar-default fixed-top bg-white"
    fixed
    role="navigation">
    <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

    <a class="navbar-brand mr-0" href="{{ url('/') }}">
        <img src="{{asset('/img/lightalarms-logo.png')}}" class="brand__logo">
    </a>

    <b-collapse is-nav id="nav_collapse">
        <ul class="nav nav-item d-flex align-items-center mr-auto">
            <li class="nav-item">
                <search-autocomplete pagelinkurl="{{URL::to('new-products')}}" searchurl="{{URL::to('search')}}"></search-autocomplete>

            </li>
            <li class="nav-item">
                <small class="navbar-text">
                    <a href="http://www.lightalarms.com"
                        target="new"
                        class="text-secondary">VISIT LIGHTALARMS WEBSITE</a>
                </small>
            </li>
        </ul>
    </b-collapse>

    <ul class="navbar-nav">
        <li class="nav-item">
            @if (Auth::user())
                <b-dropdown
                    id="dropdown-user"
                    text="{{ Auth::user()->agency()->name }}"
                    variant="link"
                    right
                >
                    @if (Auth::user()->isAdmin())
                        <a class="btn btn-link" href="{{ route('agencies.index') }}">{{ __('strings.actions.agencies') }}</a>
                    @endif

                    @if (Auth::user()->isAgencyAdmin())
                        <a class="btn btn-link" href="{{ route('agencies.index') }}">{{ __('strings.actions.agenciesadmin') }}</a>
                    @endif
                    <a class="btn btn-link" href="{{ route('logout') }}">{{ __('auth.btn.logout') }}</a>
                </b-dropdown>
            @endif
        </li>
    </ul>
</b-navbar>
