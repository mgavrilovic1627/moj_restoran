@extends("partials.layout")

@section("title")
    Izmena komentara
@endsection

@section("content")
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0">Izmena komentara</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.komentari.update', $komentar->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="user" class="form-label">Korisnik</label>
                            <input type="text" class="form-control" value="{{ $komentar->user->name }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="sto" class="form-label">Sto</label>
                            <input type="text" class="form-control" value="{{ $komentar->sto->naziv_stola }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="sadrzaj" class="form-label">Komentar</label>
                            <textarea class="form-control @error('sadrzaj') is-invalid @enderror" 
                                      id="sadrzaj" 
                                      name="sadrzaj" 
                                      rows="4" 
                                      required>{{ old('sadrzaj', $komentar->sadrzaj) }}</textarea>
                            @error('sadrzaj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ocena" class="form-label">Ocena</label>
                            <select class="form-select @error('ocena') is-invalid @enderror" 
                                    id="ocena" 
                                    name="ocena" 
                                    required>
                                <option value="">Izaberite ocenu</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('ocena', $komentar->ocena) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('ocena')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.komentari.index') }}" class="btn btn-secondary">Nazad</a>
                            <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 