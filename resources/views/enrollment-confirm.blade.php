@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Confirmação de inscrição</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p>
                Evento: <strong>{{ $event->title }}</strong>
                Dia: <strong>{{ $event->start_event->format('d/m/Y H:i') }}</strong>
            </p>
            <p>
                <a href="{{ route('enrollment.process') }}" class="btn btn-lg btn-success">Confirmação Inscrição</a>
            </p>
        </div>
    </div>
@endsection