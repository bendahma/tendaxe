@extends('layouts.layout')

@section('title', 'Publier')

@section('content')
    <div class="container main">
        <h2 class="text-center bold">Publier une annonce</h2>
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
        <div class="bg-white p-3 border my-4">
            <form action="{{ route('offre.add') }}" method="POST" enctype= multipart/form-data>
                @csrf
                <div class="form-group">
                    <label for="">Intitulé de Projet</label>
                    <input class="form-control bg-light" type="text" name="titre" required>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control bg-light" style="resize: none;" name="description" id="" rows="6"></textarea>
                </div>
                <div class="row">
                    {{-- <div class="col-md-6 form-group">
                        <label>Wilaya</label>
                        <select onchange="test()" name="wilaya" required class="form-control mb-2 wil1 selectpicker" data-live-search="true"></select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Commune</label>
                        <div class="com-container">
                            <select name="commune" required class="form-control mb-2 com1" data-live-search="true"></select>
                        </div>
                    </div> --}}
                    <div class="col-md-6 form-group">
                        <label for="">Date publication</label>
                        <input class="form-control bg-light" type="date" name="date_pub" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Date d'échéance</label>
                        <input class="form-control bg-light" type="date" name="date_lim" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Secteurs</label>
                        <select name="secteur[]" class="form-control mb-2 selectpicker" multiple title="Secteur" data-live-search="true" required>
                            @foreach (App\Models\Secteur::All() as $sect)
                                <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" >{{ $sect->secteur }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Statut</label>
                        <select name="statut" class="form-control mb-2 selectpicker" title="statut" data-live-search="true" required>
                            <option value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation">Mise en demeure et résiliation</option>
                            <option value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                            <option value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux enchères</option>
                            <option value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                            <option value="Annulation" data-tokens="Annulation">Annulation</option>
                            <option value="Attribution de marché" data-tokens="Attribution de marché">Attribution de marché</option>
                            <option value="Prorogation de délai" data-tokens="Prorogation de délai">Prorogation de délai</option>
                            <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation">Appel d'offres & Consultation</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Type</label>
                        <select name="type" class="form-control mb-2 selectpicker" required>
                            <option value="national" selected>national</option>
                            <option value="international">international</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Prix de caller de charge</label>
                        <input class="form-control bg-light" type="number" name="prix" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Fichier de publication</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input bg-light" id="customFile" name="photo">
                            <label class="custom-file-label bg-light" for="customFile">Choisir fichier</label>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary">Publier</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <script type="text/javascript">
        wilaya1(09);
        commune11(09);
        $('.com1').selectpicker();
        
        function test() {
            var t = $('.wil1').find(":selected").data("id");
            $(".com-container").html('<select name="commune" required class="form-control mb-2 com1" data-live-search="true"></select>');
            commune11(t);
            $('.com1').selectpicker();
        }
    </script> --}}
@endsection