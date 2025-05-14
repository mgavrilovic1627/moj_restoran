@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Sto #{{ $sto->broj_stola }}</h2>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h3>Detalji stola</h3>
                        <p><strong>Broj stola:</strong> {{ $sto->broj_stola }}</p>
                        <p><strong>Broj mesta:</strong> {{ $sto->broj_mesta }}</p>
                        <p><strong>Status:</strong> {{ $sto->status }}</p>
                    </div>

                    @auth
                    <div class="mb-4">
                        <h3>Dodaj komentar</h3>
                        <form action="{{ route('komentari.store', $sto->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="sadrzaj">Komentar</label>
                                <textarea name="sadrzaj" id="sadrzaj" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ocena">Ocena (1-5)</label>
                                <select name="ocena" id="ocena" class="form-control" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Dodaj komentar</button>
                        </form>
                    </div>
                    @endauth

                    <div>
                        <h3>Komentari</h3>
                        @forelse($sto->komentari as $komentar)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">{{ $komentar->user->name }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $komentar->created_at->format('d.m.Y H:i') }}</h6>
                                            <div class="card-text">{!! $komentar->sadrzaj !!}</div>
                                            <p class="card-text"><small class="text-muted">Ocena: {{ $komentar->ocena }}/5</small></p>
                                        </div>
                                        @if(auth()->id() === $komentar->user_id)
                                            <div>
                                                <button onclick="editComment({{ $komentar->id }})" class="btn btn-sm btn-primary">Izmeni</button>
                                                <form action="{{ route('komentari.destroy', $komentar->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Da li ste sigurni da želite da obrišete ovaj komentar?')">Obriši</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Još nema komentara za ovaj sto.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Izmeni komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_sadrzaj">Komentar</label>
                        <textarea name="sadrzaj" id="edit_sadrzaj" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_ocena">Ocena (1-5)</label>
                        <select name="ocena" id="edit_ocena" class="form-control" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Otkaži</button>
                    <button type="submit" class="btn btn-primary">Sačuvaj</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#sadrzaj',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 300,
        language: 'sr_RS',
        menubar: false,
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }'
    });

    tinymce.init({
        selector: '#edit_sadrzaj',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 300,
        language: 'sr_RS',
        menubar: false,
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }'
    });

    function editComment(id) {
        const comment = document.querySelector(`[data-comment-id="${id}"]`);
        const form = document.getElementById('editForm');
        
        form.action = `/komentari/${id}`;
        tinymce.get('edit_sadrzaj').setContent(comment.querySelector('.comment-content').innerHTML);
        document.getElementById('edit_ocena').value = comment.querySelector('.comment-rating').textContent.split('/')[0];
        
        $('#editModal').modal('show');
    }
</script>
@endsection
