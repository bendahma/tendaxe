@extends('layouts.layout')

@section('title', 'Mot de pass Oublier')

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="height: 70vh">
        <div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary">Envoyé</button>
                </div>
            </form>
        </div>
    </div>
@endsection