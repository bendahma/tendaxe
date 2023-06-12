@extends('layouts.layout')

@section('title', 'Changé mot de passe')

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="height: 70vh">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="">Email</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="Address Email" value="{{ $email ?? old('email') }}">
                <span class="text-danger">@error('email'){{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input id="password" type="password" class="form-control" name="password" placeholder="Nouveau mot de passe">
                <span class="text-danger">@error('password'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirmer mot de passe</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmer mot de passe">
                <span class="text-danger">@error('password_confirmation'){{$message}} @enderror</span>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Changer mot de passe</button>
            </div>
        </form>
    </div>
@endsection