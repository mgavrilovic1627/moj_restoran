@extends("partials.layout")

@section("title")
    Komentari
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

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Izlistavanje komentara</h1>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Korisnik</th>
                <th>Sto</th>
                <th>Komentar</th>
                <th>Ocena</th>
                <th>Datum</th>
                <th colspan="2" class="text-center">Opcije</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($komentari as $komentar)
            <tr>
                <td>{{ $komentar->id }}</td>
                <td>{{ $komentar->user->name }}</td>
                <td>{{ $komentar->sto->naziv_stola }}</td>
                <td>{{ Str::limit($komentar->sadrzaj, 50) }}</td>
                <td>
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $komentar->ocena)
                            <i class="fa fa-star text-warning"></i>
                        @else
                            <i class="fa fa-star-o text-warning"></i>
                        @endif
                    @endfor
                </td>
                <td>{{ $komentar->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.komentari.delete', $komentar->id) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj komentar?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Obriši</button>
                    </form>
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.komentari.edit', $komentar->id) }}" class="btn btn-warning btn-sm">Izmeni</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection 