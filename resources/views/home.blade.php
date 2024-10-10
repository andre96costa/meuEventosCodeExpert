@extends('layouts.site')

@section('title')
    Principais eventos
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Eventos</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        @forelse ($events as $event)
            <div class="col-4">
                <div class="card">
                    <img src="https://via.placeholder.com/640x480.png/0088aa?text=commodi" alt="" class="card-img-top">
                    <div class="card-body">
                        <h4 class="card-title">{{ $event->title }}</h4>
                        <strong>Acontece em {{ $event->start_event->format('d/m/Y H:i:s') }}</strong>
                        <p class="card-text">{{ $event->description }}</p>
                        <a href="{{ route('event.single', ['slug' => $event->slug]) }}" class="btn btn-default">Ver evento</a>
                        <p>Evento organizado por {{ $event->owner_name }}</p>
                    </div>
                </div>
            </div>
            @if (($loop->iteration % 3) == 0)
                </div> <div class='row mb-4'>
            @endif
        @empty
            <div class="col-12">
               <div class="alert alert-warning">Nenhum evento foi encontrado para este site...</div>
            </div>
        @endforelse
        
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
@endsection