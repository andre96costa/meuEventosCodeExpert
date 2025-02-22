@extends('layouts.app')


@section('title') Editar Evento -  @endsection

@section('content')
    <div class="row">
        <div class="col-12 my-5">
            <h2>Editar Evento</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{route('admin.events.update', ['event' => $event->id])}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Título Evento</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$event->title}}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Descrição Rápida Evento</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$event->description}}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Fale mais Sobre o Evento</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$event->body}}</textarea>
                    @error('body')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Quando Vai Acontecer?</label>
                    <input type="text" class="form-control @error('start_event') is-invalid @enderror" name="start_event" value="{{$event->start_event->format('d/m/Y H:i:s')}}">
                    @error('start_event')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="from-grupo my-5">
                    <div class="row">
                        <div class="col-12">
                            Banner
                            <hr>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('storage/'.$event->banner) }}" alt="Banner do evento {{ $event->banner }}" class="img-fluid" width="386" height="208">
                        </div>
                        <div class="col-8">
                            <label for="banner">Alterar o banner para o evento</label>
                            <input type="file" id="banner" name="banner" class="form-control @error('banner') is-invalid @enderror">
                            @error ('banner')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Quais categorias o evento pertence?</label>
                    <select class="form-control" name="categories[]" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($event->categories->contains($category)) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-lg btn-success">Atualizar Evento</button>
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