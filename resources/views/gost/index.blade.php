@extends("partials.layout")

@section("title")
    Gosti
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
        <h1>Lista gostiju</h1>
        <a href="{{ route("$prefix.gosts.create") }}" class="btn btn-primary">+ Novi gost</a>
    </div>

    <table id="gostiTabela" class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Opcije</th>
            </tr>
        </thead>
        <tbody>
            <!-- DataTables će popuniti sadržaj -->
        </tbody>
    </table>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery (potrebno za DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#gostiTabela').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route("$prefix.gosts.index") }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'ime', name: 'ime'},
                {data: 'prezime', name: 'prezime'},
                {data: 'email', name: 'email'},
                {data: 'kontakt_telefon', name: 'kontakt_telefon'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            language: {
                "lengthMenu": "Prikaži _MENU_ zapisa po stranici",
                "zeroRecords": "Ništa nije pronađeno",
                "info": "Prikazana strana _PAGE_ od _PAGES_",
                "infoEmpty": "Nema dostupnih podataka",
                "infoFiltered": "(filtrirano od ukupno _MAX_ zapisa)",
                "search": "Pretraga:",
                "paginate": {
                    "first": "Prva",
                    "last": "Poslednja",
                    "next": "Sledeća",
                    "previous": "Prethodna"
                }
            }
        });
    });
</script>

@endsection
