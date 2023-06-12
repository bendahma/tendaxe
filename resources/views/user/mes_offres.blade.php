@extends('layouts.profile')

@section('title', 'Mes Offres')

@section('link_my_offers', 'text-info')

@section('profile')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h5>Mes Offres</h5>
            </div>
            @if (Auth::user()->etat === "active")
                <div class="col-md-6 text-right">
                    <a class="btn btn-sm btn-primary px-3" href="{{ route('offre.add') }}">Ajouter un offre</a>
                </div>
            @endif
        </div>
        @if ($offres->isNotEmpty())
            @foreach ($offres as $offre)
                <x-offre :exp="false" :offre="$offre" />
            @endforeach

            {{ $offres->links() }}
        @else
            <div class="h1 text-center mt-5">Aucun offre Ajouté</div>
            @if (Auth::user()->etat === "active")
                <div class="text-center">
                    <a class="text-center" href="{{ route('offre.add') }}">Click ici pour ajouter un offre</a>
                </div>
            @endif
        @endif
    </div>
@endsection