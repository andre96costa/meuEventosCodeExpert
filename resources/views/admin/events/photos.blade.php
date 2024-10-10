@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <form action="{{ route('admin.events.photos.store', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Subir fotos do evento</label>
                    <input type="file" name="photos[]" id="photos" class="form-control @error('photos.*') is-invalid @enderror" multiple>
                    @error('photos.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-lg btn-success">Enviar fotos do evento</button>
            </form>
            <hr>
            
        </div>
    </div>
    <div class="row">
        @forelse ($event->photos as $photo)
            <div class="col-4 mb-4">
                <img src="{{ asset('storage/'.$photo->photo) }}" alt="Fotos do evento" class="img-fluid">
                <form action="{{ route('admin.events.photos.destroy', [$event, $photo]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm mt-1">Remover foto</button>
                </form>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Nenhuma foto pra este evento</div>
            </div>
        @endforelse
    </div>
@endsection