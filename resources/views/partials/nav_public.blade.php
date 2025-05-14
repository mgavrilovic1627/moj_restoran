<div class="w3-top">
  <div class="w3-bar w3-black w3-card w3-large" style="letter-spacing:4px; font-family: 'Amatic SC', cursive;">
    <a href="/" class="w3-bar-item w3-button w3-padding-large w3-hover-red" style="font-size:2em;">Restoran</a>
    <div class="w3-right w3-hide-small">
      <a href="/" class="w3-bar-item w3-button w3-padding-large w3-hover-red {{ request()->is('/') ? 'w3-red' : '' }}">Početna</a>
      <a href="/" class="w3-bar-item w3-button w3-padding-large w3-hover-red {{ request()->is('stos*') ? 'w3-red' : '' }}">Stolovi</a>
      <a href="/kontakt" class="w3-bar-item w3-button w3-padding-large w3-hover-red {{ request()->is('kontakt') ? 'w3-red' : '' }}">Kontakt</a>
      @guest
        <a href="{{ route('login') }}" class="w3-bar-item w3-button w3-padding-large w3-hover-red">Prijava</a>
        <a href="{{ route('register') }}" class="w3-bar-item w3-button w3-padding-large w3-hover-red">Registracija</a>
      @else
        <a href="{{ route('profile.edit') }}" class="w3-bar-item w3-button w3-padding-large w3-hover-red">Profil</a>
        <a href="{{ route('logout') }}" class="w3-bar-item w3-button w3-padding-large w3-hover-red"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Odjava</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      @endguest
    </div>
  </div>
</div>
