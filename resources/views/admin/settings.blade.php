@extends('layouts.panel')

@section('title', 'settings')

@section('content')
    <h3 class="text-center">Settings</h3>

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

    <div class="container-fluid bg-white">
        <form action="{{ route('admin.settings') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Ancient mot de passe</label>
                <input class="bg-light form-control" type="password" name="old_password">
            </div>
            <div class="form-group">
                <label for="">Nouveau mot de passe</label>
                <input class="bg-light form-control" type="password" name="password">
            </div>
            <div class="form-group">
                <label for="">repetez nouveau mot de passe</label>
                <input class="bg-light form-control" type="password" name="password_confirmation">
            </div>
            <div class="text-right">
                <button class="btn btn-primary px-4">Enregistrer</button>
            </div>
        </form>
    </div>
@endsection