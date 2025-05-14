@extends("partials.layout")

@section("title")
    Izmeni rezervaciju
@endsection

@section("content")
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@php
$role = Auth::user()?->role;
$prefix = $role === 'editor' ? 'editor' : 'admin';
@endphp
<div class="container my-5">
    <h1 class="mb-4 text-center">Izmeni rezervaciju</h1>

    <form action="{{ route("$prefix.rezervacijas.update", $rezervacija->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="gost_id" class="form-label">Gost</label>
            <select name="gost_id" id="gost_id" class="form-control" required>
                <option value="" disabled selected>Izaberite gosta</option>
                @foreach($gosti as $gost)
                    <option value="{{ $gost->id }}" {{ $gost->id == $rezervacija->gost_id ? 'selected' : '' }}>
                        {{ $gost->ime }} {{ $gost->prezime }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sto_id" class="form-label">Sto</label>
            <select name="sto_id" id="sto_id" class="form-control" required>
                <option value="" disabled selected>Izaberite sto</option>
                @foreach($stolovi as $sto)
                    <option value="{{ $sto->id }}" {{ $sto->id == $rezervacija->sto_id ? 'selected' : '' }}>
                        {{ $sto->naziv_stola }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="vreme" class="form-label">Vreme</label>
            <input type="datetime-local" name="vreme" id="vreme" class="form-control" value="{{ \Carbon\Carbon::parse($rezervacija->vreme)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="potvrdjeno" class="form-label">Potvrđeno</label>
            <select name="potvrdjeno" id="potvrdjeno" class="form-control" required>
                <option value="1" {{ $rezervacija->potvrdjeno == 1 ? 'selected' : '' }}>Da</option>
                <option value="0" {{ $rezervacija->potvrdjeno == 0 ? 'selected' : '' }}>Ne</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route("$prefix.rezervacijas.index") }}" class="btn btn-secondary">Nazad</a>
            <button type="submit" class="btn btn-success">Sačuvaj</button>
        </div>
    </form>
</div>
@endsection
