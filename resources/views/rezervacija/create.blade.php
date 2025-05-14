@extends("partials.layout")

@section("title")
    Nova rezervacija
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
    <h1 class="mb-4 text-center">Dodaj rezervaciju</h1>

    <form action="{{ route("$prefix.rezervacijas.store") }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="gost_id" class="form-label">Gost</label>
            <select name="gost_id" id="gost_id" class="form-control">
                @foreach ($gosti as $gost)
                    <option value="{{ $gost->id }}">{{ $gost->ime }} {{ $gost->prezime }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sto_id" class="form-label">Sto</label>
            <select name="sto_id" id="sto_id" class="form-control">
                @foreach ($stolovi as $sto)
                    <option value="{{ $sto->id }}">{{ $sto->naziv_stola }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="vreme" class="form-label">Vreme</label>
            <input type="datetime-local" name="vreme" id="vreme" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route("$prefix.rezervacijas.index") }}" class="btn btn-secondary">Nazad</a>
            <button type="submit" class="btn btn-success">Sačuvaj</button>
        </div>
    </form>
</div>
@endsection
