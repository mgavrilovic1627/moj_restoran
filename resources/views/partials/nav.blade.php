@php
    $prefix = Auth::user()?->role === 'editor' ? 'editor' : 'admin';
@endphp

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">{{ ucfirst($prefix) }} Panel</a>
        </div>
        <ul class="nav navbar-nav">
            @if($prefix === 'admin')
                <li class="{{ request()->routeIs('admin.chart.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.chart.index') }}">Statistika</a>
                </li>
            @endif
            <li class="{{ request()->is("$prefix/gosts*") ? 'active' : '' }}">
                <a href="{{ route("$prefix.gosts.index") }}">Gosti</a>
            </li>
            <li class="{{ request()->is("$prefix/stos*") ? 'active' : '' }}">
                <a href="{{ route("$prefix.stos.index") }}">Stolovi</a>
            </li>
            <li class="{{ request()->is("$prefix/rezervacijas*") ? 'active' : '' }}">
                <a href="{{ route("$prefix.rezervacijas.index") }}">Rezervacije</a>
            </li>
            @if( $prefix == "admin")
            <li class="{{ request()->is("$prefix/komentari*") ? 'active' : '' }}">
                <a href="{{ route("$prefix.komentari.index") }}">Komentari</a>
            </li>
            @endif
        </ul>

        @auth
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link navbar-btn" style="color: #9d9d9d;">Logout</button>
                    </form>
                </li>
            </ul>
        @endauth
    </div>
</nav>
