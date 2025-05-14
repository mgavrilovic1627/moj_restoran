@extends('layouts.app')

@section('title', 'Početna')

@section('content')

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

<div class="w3-container w3-padding-64 w3-red w3-grayscale w3-xlarge" id="about">
    <div class="w3-content">
        <h1 class="w3-center w3-jumbo w3-text-white" style="margin-bottom:64px">Dobrodošli</h1>
        <p class="w3-text-white">Restoran Milos Gavrilovic je mesto gde se tradicija susreće sa modernom kuhinjom. Naša priča počinje sa strastvenim zalaganjem za kvalitetnu hranu i uslugu.</p>
        
        <div class="w3-row w3-padding-32">
            <div class="w3-col m6 w3-padding-large">
                <h1 class="w3-text-white"><b>Naša Ponuda</b></h1><br>
                <h4 class="w3-text-white">Domaća Kuhinja</h4>
                <p class="w3-text-white">Tradicionalna jela pripremljena po originalnim receptima</p><br>
                
                <h4 class="w3-text-white">Mediteranska Kuhinja</h4>
                <p class="w3-text-white">Sveže morske plodove i začinjene specijalitete</p><br>
                
                <h4 class="w3-text-white">Veganska Ponuda</h4>
                <p class="w3-text-white">Zdravu i ukusnu vegansku hranu</p><br>
                
                <h4 class="w3-text-white">Domaći Dezerti</h4>
                <p class="w3-text-white">Slatke poslastice koje će vas vratiti u detinjstvo</p>
            </div>
            
            <div class="w3-col m6 w3-padding-large">
                <div class="w3-row">
                    <div class="w3-col s6 w3-padding-small">
                        <img src="https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" class="w3-round w3-image w3-opacity-min" alt="Traditional Food" style="width:100%">
                    </div>
                    <div class="w3-col s6 w3-padding-small">
                        <img src="https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1122&q=80" class="w3-round w3-image w3-opacity-min" alt="Mediterranean Food" style="width:100%">
                    </div>
                    <div class="w3-col s6 w3-padding-small">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1180&q=80" class="w3-round w3-image w3-opacity-min" alt="Vegan Food" style="width:100%">
                    </div>
                    <div class="w3-col s6 w3-padding-small">
                        <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" class="w3-round w3-image w3-opacity-min" alt="Dessert" style="width:100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="w3-container w3-padding-64 w3-white w3-grayscale w3-xlarge">
    <div class="w3-content">
        <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">Naši Stolovi</h1>
        <div class="w3-row w3-center w3-border w3-border-dark-grey">
            @foreach($stolovi as $sto)
            <a href="javascript:void(0)" onclick="openMenu(event, 'Sto{{ $sto->id }}');" id="myLink{{ $loop->first ? '' : $loop->index }}">
                <div class="w3-col s6 tablink w3-padding-large w3-hover-red">{{ $sto->naziv_stola }}</div>
            </a>
            @endforeach
        </div>

        @foreach($stolovi as $sto)
        <div id="Sto{{ $sto->id }}" class="w3-container menu w3-padding-32 w3-white">
            <div class="w3-row">
                <div class="w3-col m8">
                    <h1><b>{{ $sto->naziv_stola }}</b> <span class="w3-right w3-tag w3-dark-grey w3-round">{{ $sto->broj_mesta }} Osoba</span></h1>
                    <p class="w3-text-grey">Sto za {{ $sto->broj_mesta }} osoba, {{ $sto->za_pusace ? 'za pušače' : 'za nepušače' }}</p>
                </div>
                <div class="w3-col m4 w3-center">
                    <a href="{{ route('stos.show', $sto->id) }}" class="w3-button w3-black w3-round w3-padding-large w3-hover-red">
                        <i class="fa fa-info-circle"></i> Detalji stola
                    </a>
                </div>
            </div>
            <hr>
            
            <h1><b>Rezervacije za {{ $danas }}</b></h1>
            <div class="w3-row">
                @foreach($vremenski_slotovi as $slot)
                    @php
                        $rezervacija = $sto->rezervacije()
                            ->whereDate('vreme', $danas)
                            ->whereTime('vreme', $slot)
                            ->first();
                    @endphp
                    <div class="w3-col s3 w3-padding">
                        <div class="w3-card w3-padding {{ $rezervacija ? 'w3-red' : 'w3-green' }}" style="min-height: 100px;">
                            <p class="w3-center w3-xlarge">{{ substr($slot, 0, 5) }}</p>
                            <p class="w3-center w3-large w3-text-white">{{ $rezervacija ? 'Zauzeto' : 'Slobodno' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>

            <h1><b>Komentari</b></h1>
            @forelse($sto->komentari as $komentar)
                <div class="w3-panel w3-leftbar w3-light-grey w3-padding-16">
                    <p><i class="fa fa-quote-right w3-xxlarge w3-text-red"></i><br>
                    {{ $komentar->sadrzaj }}</p>
                    <p class="w3-text-grey">
                        - {{ $komentar->user->name }} 
                        <span class="w3-tag w3-round w3-red">{{ $komentar->ocena }}/5</span>
                    </p>
                </div>
            @empty
                <p class="w3-text-grey">Još nema komentara za ovaj sto.</p>
            @endforelse

            @auth
            <hr>
            <h1><b>Dodaj komentar</b></h1>
            <form action="{{ route('komentari.store', $sto->id) }}" method="POST">
                @csrf
                <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Vaš komentar" required name="sadrzaj"></p>
                <p>
                    <select class="w3-input w3-padding-16 w3-border" name="ocena" required>
                        <option value="">Izaberite ocenu</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </p>
                <p><button class="w3-button w3-black w3-round w3-padding-large w3-hover-red" type="submit">POŠALJI KOMENTAR</button></p>
            </form>
            @endauth
        </div>
        @endforeach
    </div>
</div>

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
@endsection
