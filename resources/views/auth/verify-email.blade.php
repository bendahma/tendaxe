@extends('layouts.layout')

@section('title', 'Verification email')

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="height: 70vh">
        <form class="text-center" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="display-4">Verifiez votre Email</div>
            <button type="submit" class="btn text-primary">Click ici pour renvoyer email de verification</button>
        </form>
    </div>
@endsection