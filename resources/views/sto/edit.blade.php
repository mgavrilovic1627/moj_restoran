@extends("partials.layout")

@section("title")
    Izmeni sto
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
    <h1 class="mb-4 text-center">Izmena stola</h1>

    <form action="{{ route("$prefix.stos.update", $sto->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="naziv_stola" class="form-label">Naziv stola</label>
            <input type="text" name="naziv_stola" id="naziv_stola" class="form-control" required
                   value="{{ $sto->naziv_stola }}">
        </div>

        <div class="mb-3">
            <label for="broj_mesta" class="form-label">Broj mesta</label>
            <input type="number" name="broj_mesta" id="broj_mesta" class="form-control" required min="1"
                   value="{{ $sto->broj_mesta }}">
        </div>

        <div class="mb-3">
            <label for="za_pusace" class="form-label">Za pušače</label>
            <select name="za_pusace" id="za_pusace" class="form-select" required>
                <option value="">Izaberi opciju</option>
                <option value="1" {{ $sto->za_pusace == 1 ? 'selected' : '' }}>Da</option>
                <option value="0" {{ $sto->za_pusace == 0 ? 'selected' : '' }}>Ne</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route("$prefix.stos.index") }}" class="btn btn-secondary">Nazad</a>
            <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
        </div>
    </form>
</div>
@endsection
