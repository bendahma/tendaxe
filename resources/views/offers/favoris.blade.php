@extends('layouts.layout')

@section('title', 'Favoris')

@section('content')
    <div class="container-fluid p-5" style="background: url({{ asset('img/banner/laptop_typing.jpg') }}) no-repeat center center; margin-top: 66px; background-size: cover;">
        <div class="container">
            <h2 class="text-white bold my-4"> Favories </h2>
        </div>
    </div>
    <div class="container mt-5">
        <x-alert />
        
        @if ($offres->count())
            @foreach ($offres as $offre)
                <x-offre :exp="$expired" :offre="$offre" />
            @endforeach
        @else
            <h3 class="text-center">Liste vide</h3>
        @endif
    
        {{-- {{ $offres->links() }} --}}
    </div>
   

@endsection