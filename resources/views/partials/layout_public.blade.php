<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head_public')
</head>
<body>

@include('partials.nav_public')

<div class="container">
    @yield('content')
</div>

@include('partials.foot_public')

<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
