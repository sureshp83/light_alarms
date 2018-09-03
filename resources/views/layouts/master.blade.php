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
            @include('inc.sidenav')
        </div>

        <div class="content">
            @include('inc.errors')

            @include('flash::message')

            @yield('content')
        </div>

        @include('inc.footer')
    </div>

    @stack("javascript")
</body>
</html>
