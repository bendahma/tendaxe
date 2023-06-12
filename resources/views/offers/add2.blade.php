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

        @if (Auth::user()->etat === "active")
            <div class="bg-white p-3 border my-4">
                <form action="{{ route('offre.add') }}" method="POST" enctype= multipart/form-data>
                    @csrf
                    <div class="form-group">
                        <label for="">Intitulé de Projet</label>
                        <input class="form-control bg-light" type="text" name="titre" value="{{ old('titre') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control bg-light" style="resize: none;" name="description" id="" rows="6">
                            {{ old('titre') }}
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Date publication</label>
                            <input class="form-control bg-light" type="date" name="date_pub"  value="{{ old('date_pub') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date d'échéance</label>
                            <input class="form-control bg-light" type="date" name="date_lim"  value="{{ old('date_lim') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Secteurs</label>
                            <select name="secteur[]" class="form-control bg-light mb-2 selectpicker" data-size="5" multiple title="Secteur" data-live-search="true" required>
                                @foreach (App\Models\Secteur::All() as $sect)
                                    <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" {{ (old('secteur') && in_array($sect->id, old('secteur'))) ? 'selected':''  }}>{{ $sect->secteur }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Statut</label>
                            <select name="statut" class="form-control bg-light mb-2 selectpicker" data-size="5" title="statut" data-live-search="true" required>
                                <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation" selected>Appel d'offres & Consultation</option>
                                <option value="Attribution de marché" data-tokens="Attribution de marché" {{ (old('statut') && in_array('Attribution de marché', old('statut'))) ? 'selected':''  }}>Attribution de marché</option>
                                <option {{ (old('statut') && in_array('Sous-traitance', old('statut'))) ? 'selected':''  }} value="Sous-traitance" data-tokens="Sous-traitance">Sous-traitance</option>
                                <option {{ (old('statut') && in_array('Prorogation de délai', old('statut'))) ? 'selected':''  }} value="Prorogation de délai" data-tokens="Prorogation de délai">Prorogation de délai</option>
                                <option {{ (old('statut') && in_array('Annulation', old('statut'))) ? 'selected':''  }} value="Annulation" data-tokens="Annulation">Annulation</option>
                                <option {{ (old('statut') && in_array('Infructuosité', old('statut'))) ? 'selected':''  }} value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                                <option {{ (old('statut') && in_array('Adjudication', old('statut'))) ? 'selected':''  }} value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                                <option {{ (old('statut') && in_array('Vente aux enchères', old('statut'))) ? 'selected':''  }} value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux enchères</option>
                                <option {{ (old('statut') && in_array('Mise en demeure et résiliation', old('statut'))) ? 'selected':''  }} value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation">Mise en demeure et résiliation</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="">Fichier de publication</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept="image/*" onchange="loadFile(event, 'fr')" id="photo" name="photo">
                                <label class="custom-file-label" for="photo2">Choisir fichier</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img id="img_fr" class="img-fluid" style="max-height: 300px;" src="#" alt="">
                        </div>
                        @if (Auth::user()->type_user !== 'content')
                        <div class="col-md-6 form-group">
                            <label for="">etablissement</label>
                            <select class="form-control bg-light selectpicker" data-size="5" name="etab" onchange="loadEtab(this)" id="" title="etablissement" data-live-search="true" data-size="5">
                                <option value="0">Autre</option>
                                {{-- get all etabs inserted by the admin --}}
                                @foreach (App\Models\Adminetab::All() as $etab)
                                <option value="{{ $etab->id }}" {{ (old('etab') && in_array($etab->id, old('etab'))) ? 'selected' : '' }}>{{ $etab->nom_etablissement }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-md-6 form-group">
                            <label for="">Wilaya offre</label>
                            <select class="wil1 form-control bg-light selectpicker" data-size="5" name="wilaya_offre" data-live-search="true">
                                <option data-id="0" value="etab" selected>Wilaya d'etablissement</option>
                            </select>
                        </div>
                    </div>
                    @if (Auth::user()->type_user !== 'content')
                    <div class="bg-white" id="last" style="display: none;">
                        <h6 class="bold mb-3">Les informations sur l’établissment</h6>
                        <div class="row">
                            <div class="col-md-6 form-group" id="nom_etab">
                                <label for="nom_etab">Nom Etablissement</label>
                                <input class="form-control bg-light" type="text" name="nom_etab">
                            </div>
                            <div class="col-md-6 form-group" id="logo_etab">
                                <label for="">logo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="logo" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choisir un logo</label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Wilaya</label>
                                <select onchange="test()" id="wilaya_etab" name="wilaya_etab" required class="wil1 form-control bg-light mb-2 selectpicker" data-size="5" data-live-search="true">
                                    <option data-id="0" selected>Aucun</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Commune</label>
                                <div class="com-container">
                                    <select name="commune_etab" required class="form-control bg-light mb-2 selectpicker com1" data-size="5" data-live-search="true">
                                    <option data-id="0" selected>Aucun</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-md-6 form-group">
                                <label for="email">Email ou siteweb</label>
                                <input class="form-control bg-light" type="email" name="email_etab">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="fix">Telephone fix</label>
                                <input class="form-control bg-light" type="text" name="fix">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Fax</label>
                                <input class="form-control bg-light" type="text" name="fax">
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="text-right">
                        <button class="btn btn-info">Publier</button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-white p-3 border my-4 d-flex align-items-center justify-content-center" style="height: 300px;">
                <h1>Compte desactivé, vous pouvez pas ajouté des offres</h1>
            </div>
        @endif
        
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

        var loadFile = function(event, lang) {
            if(lang == 'ar'){
                var output = document.getElementById('img_ar');
            }else{
                var output = document.getElementById('img_fr');
            }
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>

    @if (old('wilaya_offre'))
    <script>
        $('.wil1').val("{{ old('wilaya_offre') }}").selectpicker('refresh');
    </script>
    @endif
@endsection