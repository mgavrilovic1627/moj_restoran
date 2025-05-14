@extends('partials.layout_public')

@section('title', 'Kontakt')

@section('content')
<div class="w3-container w3-padding-64 w3-light-grey" id="contact">
    <h1 class="w3-center" style="font-family: 'Amatic SC', cursive; font-size: 60px; letter-spacing: 2px;">Kontaktirajte nas</h1>
    <div class="w3-row w3-padding-32 w3-section">
        <div class="w3-col m6 w3-large w3-margin-bottom">
            <i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> Beograd, Srbija<br>
            <i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Telefon: +381 11 1234567<br>
            <i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Email: info@restoran.rs<br>
            <br>
            <iframe src="https://www.google.com/maps?q=Beograd,+Srbija&output=embed" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="w3-col m6">
            <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="#" method="POST">
                <div class="w3-section">
                    <label for="ime" style="font-family: 'Amatic SC', cursive; font-size: 1.3em;">Ime</label>
                    <input class="w3-input w3-border" type="text" name="ime" id="ime" required>
                </div>
                <div class="w3-section">
                    <label for="email" style="font-family: 'Amatic SC', cursive; font-size: 1.3em;">Email</label>
                    <input class="w3-input w3-border" type="email" name="email" id="email" required>
                </div>
                <div class="w3-section">
                    <label for="poruka" style="font-family: 'Amatic SC', cursive; font-size: 1.3em;">Poruka</label>
                    <textarea class="w3-input w3-border" name="poruka" id="poruka" rows="5" required></textarea>
                </div>
                <button type="submit" class="w3-button w3-black w3-padding-large w3-margin-top" style="font-family: 'Amatic SC', cursive; font-size: 1.2em;">
                    <i class="fa fa-paper-plane"></i> Pošalji poruku
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 