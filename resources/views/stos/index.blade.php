@extends("partials.layout")

@section("title")
    Stolovi
@endsection

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

@php
    $role = Auth::user()?->role;
    $prefix = $role;
@endphp

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Izlistavanje stolova</h1>
        <a href="{{ route("$prefix.stos.create") }}" class="btn btn-primary">+ Dodaj novi sto</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Naziv stola</th>
                <th>Broj mesta</th>
                <th>Za pušače</th>
                <th colspan="{{ $role === 'editor' ? '1' : '2' }}" class="text-center">Opcije</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($stolovi as $sto)
            <tr>
                <td>{{ $sto->id }}</td>
                <td>{{ $sto->naziv_stola }}</td>
                <td>{{ $sto->broj_mesta }}</td>
                <td>{{ $sto->za_pusace ? 'Da' : 'Ne' }}</td>

                @if ($role !== 'editor')
                    <td>
                        <form action="{{ route("$prefix.stos.delete", $sto->id) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj sto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Obriši</button>
                        </form>
                    </td>
                @endif

                <td class="text-center">
                    <a href="{{ route("$prefix.stos.edit", $sto->id) }}" class="btn btn-warning btn-sm">Izmeni</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
