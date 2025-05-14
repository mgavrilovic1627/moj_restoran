@extends('partials.layout_public')

@section('title', 'Izmeni komentar')

@section('content')
<div class="container w3-padding-64">
    <div class="w3-row">
        <div class="w3-col m8 w3-center w3-padding">
            <div class="w3-card w3-padding">
                <h2 style="font-family: 'Amatic SC';"><i class="fa fa-edit"></i> Izmeni komentar</h2>
                
                <form action="{{ route('komentari.update', $komentar->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="w3-padding-16">
                        <label for="sadrzaj" class="w3-text-grey">Komentar:</label>
                        <textarea name="sadrzaj" 
                                  id="sadrzaj" 
                                  class="w3-input w3-border" 
                                  rows="4" 
                                  required>{{ $komentar->sadrzaj }}</textarea>
                    </div>

                    <div class="w3-padding-16">
                        <label for="ocena" class="w3-text-grey">Ocena (1-5):</label>
                        <select name="ocena" id="ocena" class="w3-select w3-border" required>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $komentar->ocena == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="w3-padding-16">
                        <button type="submit" class="w3-button w3-black w3-round">
                            <i class="fa fa-save"></i> Sačuvaj izmene
                        </button>
                        <a href="{{ url()->previous() }}" class="w3-button w3-grey w3-round">
                            <i class="fa fa-times"></i> Otkaži
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 