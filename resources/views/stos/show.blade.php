@extends('layouts.app')

@section('title', $sto->naziv_stola)

@section('content')
<div class="w3-container w3-padding-64">
    <div class="w3-row">
        <div class="w3-col m6">
            <div class="w3-card w3-padding w3-blue-grey w3-grayscale" style="margin-bottom: 32px;">
                <h2 class="w3-text-white" style="font-family: 'Amatic SC'; font-size: 4em;">{{ $sto->naziv_stola }}</h2>
                <div class="w3-padding-24">
                    <p class="w3-text-white" style="font-size: 1.5em;"><i class="fa fa-users"></i> Broj mesta: {{ $sto->broj_mesta }}</p>
                    <p class="w3-text-white" style="font-size: 1.5em;"><i class="fa fa-smoking"></i> {{ $sto->za_pusace ? 'Za pušače' : 'Za nepušače' }}</p>
                    @php
                        $prosecnaOcena = $sto->komentari->avg('ocena');
                        $punaZvezdica = floor($prosecnaOcena);
                        $polovinaZvezdice = $prosecnaOcena - $punaZvezdica >= 0.5;
                    @endphp
                    <p class="w3-text-white" style="font-size: 1.5em;">
                        <i class="fa fa-star"></i> Prosečna ocena: 
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $punaZvezdica)
                                <i class="fa fa-star w3-text-yellow"></i>
                            @elseif($i == $punaZvezdica + 1 && $polovinaZvezdice)
                                <i class="fa fa-star-half-o w3-text-yellow"></i>
                            @else
                                <i class="fa fa-star-o w3-text-yellow"></i>
                            @endif
                        @endfor
                        <span class="w3-text-white">({{ number_format($prosecnaOcena, 1) }})</span>
                    </p>
                </div>
            </div>
            
            <div class="w3-card w3-padding w3-blue-grey w3-grayscale">
                <h3 class="w3-text-white" style="font-family: 'Amatic SC'; font-size: 2.5em;"><i class="fa fa-calendar"></i> Rezervacije za današnji dan</h3>
                @foreach($vremenski_slotovi as $vreme)
                    @php
                        $vreme_pun_format = $danas . "T" . $vreme;
                        $vreme_pun_format = substr($vreme_pun_format, 0, strlen($vreme_pun_format) - 3);
                        $rezervisano = $sto->rezervacije()->where('vreme', $vreme_pun_format)->exists();
                        $boja = $rezervisano ? 'w3-red' : 'w3-green';
                        $statusText = $rezervisano ? 'Rezervisano' : 'Slobodno';
                    @endphp
                    <div class="w3-padding-16">
                        <h4 class="w3-text-white" style="font-size: 1.5em;"><b>{{ substr($vreme, 0, 5) }}</b>
                            <span class="w3-right w3-tag {{ $boja }} w3-round" style="font-size: 1.2em;">{{ $statusText }}</span>
                        </h4>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w3-col m6">
            <div class="w3-card w3-padding w3-blue-grey w3-grayscale">
                <h3 class="w3-text-white" style="font-family: 'Amatic SC'; font-size: 2.5em;"><i class="fa fa-comments"></i> Komentari</h3>
                
                @if($sto->komentari->count() > 0)
                    @foreach($sto->komentari as $komentar)
                        <div class="w3-padding-24 w3-border-bottom">
                            <div class="w3-row">
                                <div class="w3-col s2">
                                    @if($komentar->user && $komentar->user->profilna_slika)
                                        <img src="{{ asset('storage/' . $komentar->user->profilna_slika) }}" 
                                             class="w3-circle" style="width:60px;height:60px">
                                    @else
                                        <i class="fa fa-user w3-circle" style="font-size:60px;padding:10px"></i>
                                    @endif
                                </div>
                                <div class="w3-col s10">
                                    <h4 class="w3-text-white" style="font-size: 1.5em;">{{ $komentar->user ? $komentar->user->name : 'Anonimni korisnik' }}</h4>
                                    <p class="w3-text-white" style="font-size: 1.2em;">{{ $komentar->sadrzaj }}</p>
                                    <div class="w3-padding-8">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $komentar->ocena)
                                                <i class="fa fa-star w3-text-yellow" style="font-size: 1.2em;"></i>
                                            @else
                                                <i class="fa fa-star-o w3-text-yellow" style="font-size: 1.2em;"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="w3-text-white" style="font-size: 1em;">{{ $komentar->created_at->format('d.m.Y H:i') }}</small>
                                    
                                    @auth
                                        @if(auth()->user()->id === $komentar->user_id)
                                            <div class="w3-right">
                                                <a href="{{ route('komentari.edit', $komentar->id) }}" 
                                                   class="w3-button w3-small w3-blue w3-round">
                                                    <i class="fa fa-edit"></i> Izmeni
                                                </a>
                                                <form action="{{ route('komentari.destroy', $komentar->id) }}" 
                                                      method="POST" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="w3-button w3-small w3-red w3-round"
                                                            onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj komentar?')">
                                                        <i class="fa fa-trash"></i> Obriši
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="w3-text-white" style="font-size: 1.2em;">Još nema komentara za ovaj sto.</p>
                @endif

                @auth
                    <div class="w3-padding-24">
                        <h4 class="w3-text-white" style="font-size: 1.8em;">Dodaj komentar</h4>
                        <form action="{{ route('komentari.store', $sto->id) }}" method="POST">
                            @csrf
                            <div class="w3-padding-16">
                                <label for="sadrzaj" class="w3-text-white" style="font-size: 1.2em;">Komentar:</label>
                                <textarea name="sadrzaj" 
                                          class="w3-input w3-border" 
                                          rows="3" 
                                          required 
                                          style="font-size: 1.2em;"
                                          placeholder="Napišite svoj komentar..."></textarea>
                            </div>
                            <div class="w3-padding-16">
                                <label for="ocena" class="w3-text-white" style="font-size: 1.2em;">Ocena (1-5):</label>
                                <select name="ocena" id="ocena" class="w3-select w3-border" required style="font-size: 1.2em;">
                                    <option value="">Izaberite ocenu</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <button type="submit" class="w3-button w3-black w3-round w3-margin-top" style="font-size: 1.2em;">
                                <i class="fa fa-paper-plane"></i> Objavi komentar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="w3-padding-24">
                        <p class="w3-text-white" style="font-size: 1.2em;">Da biste ostavili komentar, molimo vas da se 
                            <a href="{{ route('login') }}" class="w3-text-blue">prijavite</a> ili 
                            <a href="{{ route('register') }}" class="w3-text-blue">registrujte</a>.
                        </p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection 