@extends('layouts.app')

@section('title') Meus eventos @endsection

@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-between my-3">
            <h2>Meus eventos</h2>
            <a href="{{ route('admin.events.create') }}" class="btn btn-success">Criar evento</a>
        </div>
        <div class="col-12">
            <table class="table table-rounded table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Evento</th>
                        <th>Criado Em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.events.photos.index', $event) }}" class="btn btn-primary">Fotos</a>
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Deseja remover este evento?');">Remover</button>
                                </form>
                            </td>
                        </tr>
                       
                    @empty
                        <tr><td colspan="4">Nenhum evento encontrado</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $events->links() }}
        </div>
    </div>
@endsection