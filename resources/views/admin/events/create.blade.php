@extends('layouts.app')

@section('title') Criar evento @endsection

@section('content')
    <div class="row">
        <div class="col-12 my-5">
            <h2>Criar evento</h2>
        </div>
    </div>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()

                <div class="form-group">
                    <label for="title">Titulo Evento</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error ('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                    @error ('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="body">Fale mais sobre o evento</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror"></textarea>
                    @error ('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Quando vai acontecer</label>
                    <input type="text" name="start_event" id="start_event" class="form-control @error('start_event') is-invalid @enderror" value="{{ old('start_event') }}">
                    @error ('start_event')
                    <div class="invalid-feedback">
                       {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="from-grupo">
                    <label for="banner">Criar um banner para o evento</label>
                    <input type="file" id="banner" name="banner" class="form-control @error('banner') is-invalid @enderror">
                    @error ('banner')
                    <div class="invalid-feedback">
                       {{ $message }}
                    </div>
                    @enderror
                </div>
                <br>

                <div class="form-group">
                    <label for="">Quais categorias o evento pertence?</label>
                    <select class="form-control" name="categories[]" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-lg btn-success">Criar evento</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let el = document.querySelector('input[name=start_event]');
    let im = new Inputmask('99/99/9999 99:99');
    im.mask(el);
</script>
@endsection