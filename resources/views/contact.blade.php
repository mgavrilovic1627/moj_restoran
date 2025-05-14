@extends('layouts.app')

@section('title', 'Kontakt')

@section('content')

<div class="w3-container w3-padding-64 w3-blue-grey w3-grayscale-min w3-xlarge">
    <div class="w3-content">
        <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">Kontakt</h1>
        
        <div class="w3-row w3-padding-32">
            <div class="w3-col m6 w3-padding-large">
                <h2 class="w3-text-white"><b>Pronađite nas</b></h2>
                <p class="w3-text-white"><i class="fa fa-map-marker w3-margin-right"></i> 27. marta 39, Beograd</p>
                <p class="w3-text-white"><i class="fa fa-phone w3-margin-right"></i> 05050515-122330</p>
                <p class="w3-text-white"><i class="fa fa-envelope w3-margin-right"></i> info@restoran-milos.com</p>
                
                <h2 class="w3-text-white w3-padding-32"><b>Radno vreme</b></h2>
                <p class="w3-text-white">Ponedeljak - Petak: 10:00 - 00:00</p>
                <p class="w3-text-white">Subota - Nedelja: 10:00 - 02:00</p>
            </div>
            
            <div class="w3-col m6 w3-padding-large">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.739495785907!2d20.4541!3d44.8156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDTCsDQ4JzU2LjEiTiAyMMKwMjcnMTQuOCJF!5e0!3m2!1sen!2srs!4v1647881234567!5m2!1sen!2srs" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        class="w3-round">
                </iframe>
            </div>
        </div>

        <div class="w3-row w3-padding-32">
            <div class="w3-col m12">
                <h2 class="w3-text-white"><b>Rezervišite sto ili nam pošaljite poruku</b></h2>
                <form action="/contact" method="POST" class="w3-padding-32">
                    @csrf
                    <div class="w3-row-padding">
                        <div class="w3-col m6">
                            <input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Ime" required name="name">
                        </div>
                        <div class="w3-col m6">
                            <input class="w3-input w3-padding-16 w3-border" type="number" placeholder="Broj osoba" required name="people">
                        </div>
                    </div>
                    <div class="w3-row-padding w3-padding-16">
                        <div class="w3-col m6">
                            <input class="w3-input w3-padding-16 w3-border" type="datetime-local" placeholder="Datum i vreme" required name="date" value="2024-03-16T20:00">
                        </div>
                        <div class="w3-col m6">
                            <input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Poruka \ Posebni zahtevi" required name="message">
                        </div>
                    </div>
                    <button class="w3-button w3-black w3-round w3-padding-large w3-hover-red" type="submit">POŠALJI PORUKU</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 