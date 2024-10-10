@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-12">
                        <h3>Dados de acesso</h3>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Nome Completo</label>
                    <input type="text" class="form-control @error('user.name') is-invalid @enderror"  name="user[name]" value="{{ $user->name }}">
                    @error('user.name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control @error('user.email') is-invalid @enderror" name="user[email]" value="{{ $user->email }}">
                    @error('user.email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Senha</label>
                    <input type="password" class="form-control @error('user.password') is-invalid @enderror" name="user[password]">
                    @error('user.password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Confirmar senha</label>
                    <input type="password" class="form-control" name="user[password_confirmation]">
                </div>

                <div class="row">
                    <div class="col-12">
                        <h3>Dados de perfil</h3>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Sobre</label>
                    <textarea name="profile[about]" id="" cols="30" rows="10" class="form-control">{{ $user->profile->about }}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Contato</label>
                    <input type="text" class="form-control" name="profile[phone]" value="{{ $user->profile->phone }}">
                </div>

                <div class="form-group">
                    <label for="">Redes Sociais</label>
                    @php
                        $socialNetworks = $user->profile->social_networks;
                    @endphp
                    <input type="text" class="form-control" name="profile[social_networks][facebook]" value="{{ array_key_exists('facebook', $socialNetworks) ? $socialNetworks['facebook'] : null }}" placeholder="facebook"> <br>
                    <input type="text" class="form-control" name="profile[social_networks][twitter]" value="{{ array_key_exists('twitter', $socialNetworks) ? $socialNetworks['twitter'] : null }}" placeholder="twitter"> <br>
                    <input type="text" class="form-control" name="profile[social_networks][instagram]" value="{{ array_key_exists('instagram', $socialNetworks) ? $socialNetworks['instagram'] : null }}" placeholder="instagram">
                </div>

                <button class="btn btn-success">Atualizar perfil</button>
            </form>
        </div>
    </div>
@endsection