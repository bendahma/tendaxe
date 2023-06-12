@extends('layouts.layout')

@section('title', 'Documents utiles')

@section('content')
    <div class="container-fluid px-md-5 py-5" style="background: url({{ asset('img/banner/open_book.jpg') }}) no-repeat center center; margin-top: 66px; background-size: cover;">
        <div class="">
            <h3 class="text-white bold my-4">Documents utiles</h3>
        </div>
    </div>

    <div class="container mt-5">
        <h4 class="font-weight-600 mb-3">Modèles des éléments composants les offres techniques et financières</h4>
        
        <div class="text-muted mb-3 font-weight-400">Afin de vous assister à la préparation de vos offres (dossier technique, financier et candidature)</div>

        <a href="/pdf/Model-lettre-de-soumission.pdf" download  class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3 text-dark font-weight-500">MODEL LETTRE DE SOUMISSION</span>
        </a>

        <a href="/pdf/MODELE-DE-DECLARATION-DE PROBITE.pdf" download class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3 text-dark font-weight-500">MODEL DÉCLARATION DE PROBITÉ</span>
        </a>

        <a href="/pdf/MODELE-DE-DECLARATION-DE-CANDIDATURE.pdf" download class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3 text-dark font-weight-500">MODEL DÉCLARATION DE CANDIDATURE</span>
        </a>

        <a href="/pdf/Model-declaration-a-souscrire.pdf" download class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3 text-dark font-weight-500">MODEL DÉCLARATION À SOUSCRIRE</span>
        </a>

        <a href="/pdf/MODELE-DE-DECLARATION-DE SOUS-TRAITANTf.pdf" download class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3 text-dark font-weight-500">MODEL DÉCLARATION DE SOUS-TRAITANT</span>
        </a>

        <a href="/pdf/MODELE-D'ENGAGEMENT-D'INVESTISSEMENT.pdf" download class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3 text-dark font-weight-500">MODEL D’ENGAGEMENT D’INVESTISSEMENT</span>
        </a>
        
        <h4 class="font-weight-600 mb-3">Documents administratifs</h4>

        <a href="/pdf/F2018077.pdf" download class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3 text-dark font-weight-500">JOURNAL OFFICIEL DE LA RÉPUBLIQUE ALGÉRIENNE PUBLIÉ 23 DÉCEMBRE 2018</span>
        </a>
        <a href="/pdf/manuel-ue.pdf" download class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3 text-dark font-weight-500">MANUEL SUR LES RÈGLES DE L’ORIGINE DES MARCHANDISES DANS LE CADRE DE L'ACCORD D'ASSOCIATION ALGÉRIE UE</span>
        </a>
        <a href="/pdf/FMPublic.pdf" download class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <div class="ml-3">
                <span class="text-dark font-weight-500">CODE DES MARCHÉS PUBLICS</span>
                <br>
                <span class="text-muted">Decret presidentiel n°15-247 du 2 Dhou El Hidja 1436 correspondant au 16 septembre 2015</span>
            </div>
        </a>
    </div>
@endsection