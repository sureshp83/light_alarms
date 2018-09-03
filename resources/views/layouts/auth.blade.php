<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include("inc.head")
</head>
<body>
    @include('inc.icons-svg')

    <div id="app" class="auth-container">
        @yield('content')
    </div>

    @stack("javascript")
</body>
</html>
