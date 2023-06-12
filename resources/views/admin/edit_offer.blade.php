@extends('layouts.panel')

@section('title', 'edit offer')
    
@section('content')
<h2 class="text-center bold">Modifier annonce</h2>

@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

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
@if (Auth::user()->type_user === "content" && Auth::user()->etat === "desactive")
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <strong>Compte desactivé</strong> Veillez contacter Administration pour l'activé.
        </div>
    </div>
@else
<div class="bg-white p-3 border my-4">
    <form action="{{ (Auth::user()->type_user !== 'content') ? route('admin.offers.edit', $offre) : route('rep.offers.edit', $offre) }}" method="POST" enctype= multipart/form-data>
        @csrf
        <div class="form-group">
            <label for="">Intitulé de Projet</label>
            <input class="form-control" type="text" name="titre" value="{{ $offre->titre }}" required>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea class="form-control" style="resize: none;" name="description" id="" rows="6">{{ $offre->description }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="">Date publication</label>
                <input class="form-control" type="date" name="date_pub" value="{{ $offre->date_pub }}" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Date d'échéance</label>
                <input class="form-control" type="date" name="date_lim" value="{{ $offre->date_limit }}" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Secteurs</label>
                <select name="secteur[]" class="form-control mb-2 selectpicker" multiple title="Secteur" data-live-search="true" data-size="5" required>
                    @foreach (App\Models\Secteur::All() as $sect)
                        <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" {{ (in_array($sect->id, $secteurs)) ? "selected" : "" }}>{{ $sect->secteur }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Statut</label>
                <select name="statut" class="form-control mb-2 selectpicker" title="statut" data-live-search="true" data-size="5" required>
                    <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation" {{ ($offre->statut === "Appel d'offres & Consultation") ? "selected" : "" }}>Appel d'offres & Consultation</option>
                    <option value="Attribution de marché" data-tokens="Attribution de marché" {{ ($offre->statut === "Attribution de marché") ? "selected" : "" }}>Attribution de marché</option>
                    <option value="Sous-traitance" data-tokens="Sous-traitance" {{ ($offre->statut === "Sous-traitance") ? "selected" : "" }}>Sous-traitance</option>
                    <option value="Annulation" data-tokens="Annulation" {{ ($offre->statut === "Annulation") ? "selected" : "" }}>Annulation</option>
                    <option value="Infructuosité" data-tokens="Infructuosité" {{ ($offre->statut === "Infructuosité") ? "selected" : "" }}>Infructuosité</option>
                    <option value="Adjudication" data-tokens="Adjudication" {{ ($offre->statut === "Adjudication") ? "selected" : "" }}>Adjudication</option>
                    <option value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation" {{ ($offre->statut === "Mise en demeure et résiliation") ? "selected" : "" }}>Mise en demeure et résiliation</option>
                    <option value="Vente aux enchères" data-tokens="Vente aux enchères" {{ ($offre->statut === "Vente aux enchères") ? "selected" : "" }}>Vente aux enchères</option>
                    <option value="Prorogation de délai" data-tokens="Prorogation de délai" {{ ($offre->statut === "Prorogation de délai") ? "selected" : "" }}>Prorogation de délai</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Type</label>
                <select name="type" class="form-control mb-2 selectpicker" data-size="5" required>
                    <option value="national" {{ ($offre->type === "national") ? "selected" : "" }}>national</option>
                    <option value="international" {{ ($offre->type === "international") ? "selected" : "" }}>international</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Prix de caller de charge</label>
                <input class="form-control" type="number" value="{{ $offre->prix }}" name="prix">
            </div>
            <div class="col-md-6 form-group">
                <img class="mx-auto" width="100px" height="50px" src="{{ asset('img/fr.jpg') }}" alt="">
                <label for="">Journal FR</label>
                <select class="form-control selectpicker" onchange="fr(this)" name="journal_fr" id="">
                    <option value="-1" selected>Aucun</option>
                    <option value="0">Autre</option>
                    {{-- get list of fr newspaperes --}}
                    @foreach (App\Models\Journalfr::All() as $journ)
                        <option value="{{ $journ->id }}" {{ ($offre->journalfr_id == $journ->id) ? "selected" : "" }}>{{ $journ->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- fr newspaper inputs --}}
            <div class="row px-0 mx-auto" id="journal_fr" style="display: none;">
                <div class="col-md-6 form-group">
                    <label for="">Nom journal fr</label>
                    <input class="form-control" type="text" name="nom_journal_fr">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">logo journal</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="logo_journal_fr">
                        <label class="custom-file-label" for="customFile">logo journal fr</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <img class="mx-auto" width="100px" height="50px" src="{{ asset('img/ar.jpg') }}" alt="">
                <label for="">Journal AR</label>
                <select class="form-control selectpicker" onchange="ar(this)" name="journal_ar" data-size="5" id="">
                    <option value="-1" selected>Aucun</option>
                    <option value="0">Autre</option>
                    {{-- get list of ar newspaperes --}}
                    @foreach (App\Models\Journalar::All() as $journ)
                        <option value="{{ $journ->id }}" {{ ($offre->journalar_id == $journ->id) ? "selected" : "" }}>{{ $journ->nom }}</option>
                    @endforeach
                </select>
            </div>
            {{-- ar newspaper inputs --}}
            <div class="row px-0 mx-auto" id="journal_ar" style="display: none;">
                <div class="col-md-6 form-group">
                    <label for="">Nom journal ar</label>
                    <input class="form-control" type="text" name="nom_journal_ar">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">logo journal</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="logo_journal_ar">
                        <label class="custom-file-label" for="customFile">logo journal ar</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Fichier de publication AR</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="photo">
                        <label class="custom-file-label" for="customFile">Choisir fichier</label>
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($offre->img_offre)
                        fichier Ar
                        <img class="img-fluid" src="{{ asset('storage/' . $offre->img_offre) }}">
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Fichier de publication FR</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="photo2">
                        <label class="custom-file-label" for="customFile">Choisir fichier</label>
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($offre->img_offre2)
                    fichier Fr
                    <img class="img-fluid" src="{{ asset('storage/' . $offre->img_offre2) }}">
                    @endif
                </div>
                
            </div>

            @if ($user_type !== "content")
            <div class="col-md-6 form-group">
                <label for="">etablissement</label>
                <select class="form-control selectpicker" name="etab" onchange="loadEtab(this)" id="" title="etablissement" data-size="5" data-live-search="true">
                    <option value="0">Autre</option>
                    {{-- get all etabs inserted by the admin --}}
                    @foreach (App\Models\Adminetab::All() as $etab)
                    {{-- <option value="{{ $etab->id }}" {{ ($offre->adminetab_id == $etab->id) ? "selected" : "" }}>{{ \Illuminate\Support\Str::limit($etab->nom_etablissement, 50, $end='...') }}</option> --}}
                    <option value="{{ $etab->id }}">{{ $etab->nom_etablissement }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="col-md-6 form-group">
                <label for="">Wilaya offre</label>
                <select class="wil1 form-control selectpicker" id="wilaya_offre" name="wilaya_offre" data-size="5" data-live-search="true">
                    <option data-id="0">Wilaya d'etablissement</option>
                </select>
            </div>
            
        </div>

        
        @if ($user_type !== "content")
        <div class="bg-white" id="last" style="display: none;">
            <h6 class="bold mb-3">Les informations sur l’établissment</h6>
            <div class="row">
                <div class="col-md-6 form-group" id="nom_etab">
                    <label for="nom_etab">Nom Etablissement</label>
                    <input class="form-control" type="text" name="nom_etab">
                </div>
                <div class="col-md-6 form-group" id="logo_etab">
                    <label for="">logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo" id="customFile">
                        <label class="custom-file-label" for="customFile">Choisir un logo</label>
                    </div>
                </div>
                {{-- <div class="col-md-6 form-group">
                    <label>Category</label>
                    <select name="category" required class="form-control mb-2 selectpicker" onchange="categ(this)" data-live-search="true">
                        <option value="APC" data-tokens="APC">APC</option>
                        <option value="DTP" data-tokens="DTP">DTP</option>
                        <option value="DUCH" data-tokens="DUCH">DUCH</option>
                        <option value="OPGI" data-tokens="OPGI">OPGI</option>
                        <option value="DLEP" data-tokens="DLEP">DLEP</option>
                        <option value="AUTRE" data-tokens="AUTRE">AUTRE</option>
                    </select>
                </div> --}}
                <div class="col-md-6 form-group">
                    <label>Wilaya</label>
                    <select onchange="test()" id="wilaya_etab" name="wilaya_etab" required class="wil1 form-control mb-2 selectpicker" data-size="5" data-live-search="true">
                        <option data-id="0" selected>Aucun</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Commune</label>
                    <div class="com-container">
                        <select name="commune_etab" required class="form-control mb-2 selectpicker com1" data-size="5" data-live-search="true">
                        <option data-id="0" selected>Aucun</option>
                        </select>
                    </div>
                </div>
               
                <div class="col-md-6 form-group">
                    <label for="email">Email ou siteweb</label>
                    <input class="form-control" type="email" name="email_etab">
                </div>
                <div class="col-md-6 form-group">
                    <label for="fix">Telephone fix</label>
                    <input class="form-control" type="text" name="fix">
                </div>
                <div class="col-md-6 form-group">
                    <label for="phone">Fax</label>
                    <input class="form-control" type="text" name="fax">
                </div>
            </div>
        </div>
        @endif
        
        <div class="text-right">
            <button class="btn btn-info">Modifier</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    wilaya1();
    //commune11();
    $('.com1').selectpicker();
    
    function test() {
        var t = $('#wilaya_etab').find(":selected").data("id");
        $(".com-container").html('<select name="commune_etab" required class="form-control mb-2 com1" data-live-search="true"></select>');
        if(t == 0){
            $(".com1").html('<option data-id="0" selected>Aucun</option>');
        }else{
            commune11(t);
        }
        $('.com1').selectpicker();
    }

    function categ(e) {
        if(e.value === "AUTRE"){
            $("#nom_etab").show();
            $("#logo_etab").show();
        }else{
            $("#nom_etab").hide();
            $("#logo_etab").hide();
        }
    }

    function loadEtab(e) {
        if(e.value == 0){
            $('#last').show()
        }else{
            $('#last').hide()
        }
    }

    function ar(e) {
        if(e.value == 0){
            $('#journal_ar').show()
        }else{
            $('#journal_ar').hide()
        }
    }

    function fr(e) {
        if(e.value == 0){
            $('#journal_fr').show()
        }else{
            $('#journal_fr').hide()
        }
    }

    $("#wilaya_offre").val("{{ $offre->wilaya }}");
</script>
@endif
@endsection