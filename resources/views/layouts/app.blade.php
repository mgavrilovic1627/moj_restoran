<!DOCTYPE html>
<html lang="sr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') - Restoran Milos Gavrilovic</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body, html {height: 100%}
            body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif}
            .menu {display: none}
            .bgimg {
                background-repeat: no-repeat;
                background-size: cover;
                background-image: url("https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80");
                min-height: 90%;
            }
            .w3-card {
                margin-bottom: 16px;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
            }
            .w3-card:hover {
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            }
            .w3-red {
                background-color: #f44336 !important;
            }
            .w3-text-white {
                color: #fff !important;
            }
            .w3-padding-16 {
                padding-top: 16px !important;
                padding-bottom: 16px !important;
            }
            .w3-margin-bottom {
                margin-bottom: 16px !important;
            }
        </style>
    </head>
    <body>
        
        
<div class="w3-top w3-hide-small">
    <div class="w3-bar w3-xlarge w3-black w3-opacity w3-hover-opacity-off" id="myNavbar">
        <a href="/" class="w3-bar-item w3-button">POČETNA</a>
        <a href="{{ route('stos.reservations') }}" class="w3-bar-item w3-button">REZERVACIJE STOLOVA</a>
        <a href="/about" class="w3-bar-item w3-button">O NAMA</a>
        <a href="/contact" class="w3-bar-item w3-button">KONTAKT</a>

        <div class="w3-right">
            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="w3-bar-item w3-button" style="background-color: #333;">LOGOUT</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="w3-bar-item w3-button">LOGIN</a>
                <a href="{{ route('register') }}" class="w3-bar-item w3-button">REGISTRACIJA</a>
            @endguest
        </div>
    </div>
</div>


<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
    <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
        <a href="/" class="w3-bar-item w3-button" style="width:20% !important">POČETNA</a>
        <a href="{{ route('stos.reservations') }}" class="w3-bar-item w3-button" style="width:20% !important">REZERVACIJE</a>
        <a href="/about" class="w3-bar-item w3-button" style="width:20% !important">O NAMA</a>
        <a href="/contact" class="w3-bar-item w3-button" style="width:20% !important">KONTAKT</a>

        @auth
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="w3-bar-item w3-button" style="width:20% !important; background-color: #333;">LOGOUT</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="w3-bar-item w3-button" style="width:10% !important">LOGIN</a>
            <a href="{{ route('register') }}" class="w3-bar-item w3-button" style="width:10% !important">REG</a>
        @endguest
    </div>
</div>

@section("content")
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        

        
        <header class="bgimg w3-display-container w3-grayscale-min" id="home">
            <div class="w3-display-bottomleft w3-padding">
                <span class="w3-tag w3-xlarge">Open from 10am to 12pm</span>
            </div>
            <div class="w3-display-middle w3-center">
                <span class="w3-text-white" style="font-size:90px">Restoran<br>Milos Gavrilovic</span>
            </div>
        </header>

        
        <div class="w3-content w3-padding-64">
            @yield('content')
        </div>

        
        <footer class="w3-center w3-black w3-padding-48 w3-xxlarge">
            <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
        </footer>

        <script>
            function openMenu(evt, menuName) {
                var i, x, tablinks;
                x = document.getElementsByClassName("menu");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
                }
                document.getElementById(menuName).style.display = "block";
                evt.currentTarget.firstElementChild.className += " w3-red";
            }
            document.getElementById("myLink").click();
        </script>
    </body>
</html>
