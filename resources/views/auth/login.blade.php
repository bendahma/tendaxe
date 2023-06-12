@extends('layouts.layout')

@section('title', 'Connexion')

@section('content')
	<div class="container main">
		<h2 class="bold text-center">Connexion</h2>
		<form class="bg-white border px-4 pt-3 mx-auto mb-5 rounded" style="max-width: 360px" method="POST" action="{{ route('login') }}">
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
			    </div>
            @endif

			@if (session('error'))
				<div class="alert alert-danger" role="alert">
					{{ session('error') }}
			    </div>
            @endif

			@csrf
			<div class="form-group">
				<label>Email</label>
				<input class="form-control bg-light" type="email" name="email" required value="{{ old('email')}}">
			</div>
			<div class="form-group">
				<label>mot de pass</label>
				<input class="form-control bg-light" type="password" name="password" required>
				<a href="{{ route('password.request') }}">Mot de passe oublié?</a>

			</div>
			<div class="form-check mb-2">
				<input class="form-check-input" id="remember" type="checkbox" name="remember">
				<label class="form-check-label" for="remember">se souvenir du mot de passe</label>
			</div>
			<div class="form-group">
				<button class="btn btn-primary w-100">Connexion</button>
			</div>
			<div class="text-center p-2 my-2">
				Vous n'avez pas un compte? <a href="{{ route('register') }}"> Inscrivez-vous!</a>
			</div>
		</form>
	</div>
@endsection