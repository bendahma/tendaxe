@extends('layouts.layout')

@section('title', 'Inscription')

@section('content')
    <div class="container main">
        <h2 class="text-center pt-4 bold">Selectionnez votre catégorie</h2>
        <div class="row my-5 justify-content-center">
            <div class="col-md-5 mb-3">
                <div class="bg-white p-3 text-center mx-auto shadow" style="max-width: 322px;">
                    <img src="{{ asset('img/icons/etab.png') }}" alt="">
                    <h4 class="my-3 bold">Représentant d’un établissement</h4>
                    <p>appel
                        d’offre ou consultation, attribution
                        annulation mise à jour …</p>
                    <a href="{{ route('register') . '/2' }}" class="btn btn-primary py-2 w-100 mt-auto d-flex justify-content-between">
                        Action button 
                        <img src="{{ asset('img/icons/arrow.png') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md-5 mb-3">
                <div class="bg-white p-3 h-100 d-flex flex-column align-items-center mx-auto shadow" style="max-width: 322px;">
                    <img src="{{ asset('img/icons/user2.png') }}" alt="">
                    <h4 class="my-3 bold">Un abonné ordinaire</h4>
                    <p class="text-center">publier sous-traitance
                        ou des appels à des petit projet …</p>
                    <a href="{{ route('register') . '/1' }}" class="btn btn-primary py-2 w-100 mt-auto d-flex justify-content-between">
                        Action button 
                        <img src="{{ asset('img/icons/arrow.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection