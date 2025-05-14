@extends("partials.layout")

@section("title")
    Izmena gosta
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
    <h1 class="mb-4 text-center">Izmeni podatke gosta</h1>

    <form action="{{ route("$prefix.gosts.update", $gost->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ime" class="form-label">Ime</label>
            <input type="text" name="ime" id="ime" class="form-control" value="{{ old('ime', $gost->ime) }}" required>
        </div>

        <div class="mb-3">
            <label for="prezime" class="form-label">Prezime</label>
            <input type="text" name="prezime" id="prezime" class="form-control" value="{{ old('prezime', $gost->prezime) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $gost->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="kontakt_telefon" class="form-label">Kontakt telefon</label>
            <input type="text" name="kontakt_telefon" id="kontakt_telefon" class="form-control" value="{{ old('kontakt_telefon', $gost->kontakt_telefon) }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route("$prefix.gosts.index") }}" class="btn btn-secondary">Nazad</a>
            <button type="submit" class="btn btn-success">Sačuvaj izmene</button>
        </div>
    </form>
</div>
@endsection
