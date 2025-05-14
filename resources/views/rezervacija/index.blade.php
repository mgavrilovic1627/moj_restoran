@extends("partials.layout")

@section("title")
    Rezervacije
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
    $prefix = $role === 'editor' ? 'editor' : 'admin';
@endphp

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista rezervacija</h1>
        <a href="{{ route("$prefix.rezervacijas.create") }}" class="btn btn-primary">+ Nova rezervacija</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Gost</th>
                <th>Sto</th>
                <th>Vreme</th>
                <th>Potvrđeno</th>
                <th colspan="3" class="text-center">Opcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rezervacije as $rez)
                <tr>
                    <td>{{ $rez->id }}</td>
                    <td>{{ $rez->gost->ime }} {{ $rez->gost->prezime }}</td>
                    <td>{{ $rez->sto->naziv_stola }}</td>
                    <td>{{ $rez->vreme }}</td>
                    <td>{{ $rez->potvrdjeno ? 'Da' : 'Ne' }}</td>

                    {{-- DELETE dugme prikazuje se samo ako nije editor --}}
                    @if ($role !== 'editor')
                        <td>
                            <form action="{{ route("$prefix.rezervacijas.delete", $rez->id) }}" method="POST" onsubmit="return confirm('Da li ste sigurni?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Obriši</button>
                            </form>
                        </td>
                    @else
                        <td></td>
                    @endif

                    <td class="text-center">
                        <a href="{{ route("$prefix.rezervacijas.edit", $rez->id) }}" class="btn btn-warning btn-sm">Izmeni</a>
                    </td>

                    @if (!$rez->potvrdjeno)
                        <td class="text-center">
                            <form action="{{ route("$prefix.rezervacijas.confirm", $rez->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Potvrdi</button>
                            </form>
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
