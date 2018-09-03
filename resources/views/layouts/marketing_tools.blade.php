<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include("inc.head")
</head>
<body>
    @include('inc.icons-svg')

    <div id="app" class="app">
        @include('inc.header')

        {{-- Sidebar menu for the regular user.--}}
        <div class="sidenav">
            {{ menu('application', 'inc.sidenav') }}
        </div>

        <div class="content">
            <div class="row">
                <div class="col col-10">
                    @include('inc.errors')
                    @include('flash::message')

                    @yield('content')
                </div>
            </div>
        </div>

        @include('inc.footer')
    </div>

    @stack("javascript")
</body>
</html>
