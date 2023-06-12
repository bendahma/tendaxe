<?php
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Models\Wilaya;
$currenttime = date('Y-m-d');
$daystoadd = 15;
$datefinpub = date('Y-m-d', strtotime($currenttime . "+ $daystoadd days"));


/*$currentPage = 1;
$collect_pictures = collect($Array_pictures);
$offset = ($currentPage - 1) * 10;
$paginatedPicture = $collect_pictures->slice($offset, 10);

$pic = new LengthAwarePaginator($paginatedPicture, $collect_pictures->count(), 10, $currentPage);*/

?>
@extends('layouts.panel')

@section('title', 'add offer')

@section('content')
    <h2 class="text-center bold">List des offers</h2>

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    @if (Auth::user()->type_user === 'content' && Auth::user()->etat === 'desactive')
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <strong>Compte desactivé</strong> Veillez contacter Administration pour l'activé.
            </div>
        </div>
    @else
        <form action="{{ route('admin.offers.addoffergroup') }}" method="get" enctype=multipart/form-data>
            @csrf

            @foreach ($Array_pic_names as $picture)
                <div class="bg-white p-3 border my-4">
                    <h3 style="text-align: center">{{ $picture }}</h3>
                    <input type="hidden" name="pic" value="{{ $picture }}">
                    <div class="form-group">
                        <label for="">Intitulé de Projet</label>
                        <input class="form-control" type="text" name="titre[]">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" style="resize: none;" name="description[]" id="" rows="6"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Date publication</label>
                            <input class="form-control" type="date" value="<?php echo $currenttime; ?>" name="date_pub[]">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date d'échéance</label>
                            <input class="form-control" type="date" name="date_lim[]" value="<?php echo $datefinpub; ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Statut</label>
                            <select name="statut[]" class="form-control mb-2 selectpicker" title="statut"
                                data-live-search="true" data-size="5">
                                <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation"
                                    selected>Appel d'offres & Consultation</option>
                                <option value="Attribution de marché" data-tokens="Attribution de marché">Attribution de
                                    marché</option>
                                <option value="Sous-traitance" data-tokens="Sous-traitance">Sous-traitance</option>
                                <option value="Prorogation de délai" data-tokens="Prorogation de délai">Prorogation de délai
                                </option>
                                <option value="Annulation" data-tokens="Annulation">Annulation</option>
                                <option value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                                <option value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                                <option value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux enchères
                                </option>
                                <option value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation">
                                    Mise en demeure et résiliation</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <img class="mx-auto" width="100px" height="50px" src="{{ asset('img/fr.jpg') }}"
                                alt="">
                            <label for="">Journal</label>
                            <select class="form-control selectpicker" data-live-search="true" onchange="fr(this)"
                                data-size="5" name="journal_fr[]" id="">
                                <option value="-1" selected>Aucun</option>
                                <option value="0">Autre</option>
                                {{-- get list of fr newspaperes --}}
                                @foreach (App\Models\Journalfr::All() as $journ)
                                    <option value="{{ $journ->id }}" data-tokens="{{ $journ->nom }}">
                                        {{ $journ->nom }}</option>
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
                                    <input type="file" class="custom-file-input" id="customFile"
                                        name="logo_journal_fr">
                                    <label class="custom-file-label" for="customFile">logo journal fr</label>
                                </div>
                            </div>
                        </div>


                        @if (Auth::user()->type_user !== 'content')
                            <div class="col-md-6 form-group">
                                <label for="">etablissement</label>
                                <select class="form-control selectpicker" name="etab[]" onchange="loadEtab(this)"
                                    id="" title="etablissement" data-live-search="true" data-size="5">
                                    <option value="0">Autre</option>
                                    {{-- get all etabs inserted by the admin --}}
                                    @foreach (App\Models\Adminetab::All() as $etab)
                                        {{-- <option value="{{ $etab->id }}">{{ \Illuminate\Support\Str::limit($etab->nom_etablissement, 50, $end='...') }}</option> --}}
                                        <option value="{{ $etab->id }}">{{ $etab->nom_etablissement }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-md-6 form-group">
                            <label for="">Wilaya offre</label>
                            <select class="wil1 form-control selectpicker" name="wilaya_offre[]" data-live-search="true"
                                data-size="5">

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
                                    <input class="form-control" type="text" name="nom_etab[]">
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
                                    <select onchange="test()" id="wilaya_etab" name="wilaya_etab"
                                        class="wil1 form-control mb-2 selectpicker" data-live-search="true">
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Commune</label>
                                    <div class="com-container">
                                        <select name="commune_etab" class="form-control mb-2 selectpicker com1"
                                            data-size="5" data-live-search="true">
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
                        <a href="">
                            <button class="btn btn-info"> Download </button>
                        </a>
                        <a href="">
                            <button class="btn btn-info" style="margin: 10px;"> Voir </button>
                        </a>
                    </div>



                </div>
            @endforeach

            <div class="text-right">
                <button class="btn btn-info">Publier</button>
            </div>
        </form>

        <script type="text/javascript">
            wilaya1();
            //commune11();
            $('.com1').selectpicker();

            function test() {
                var t = $('#wilaya_etab').find(":selected").data("id");
                $(".com-container").html(
                    '<select name="commune_etab"  class="form-control mb-2 com1" data-live-search="true"></select>');
                if (t == 0) {
                    $(".com1").html('<option data-id="0" selected>Aucun</option>');
                } else {
                    commune11(t);
                }
                $('.com1').selectpicker();
            }

            function categ(e) {
                if (e.value === "AUTRE") {
                    $("#nom_etab").show();
                    $("#logo_etab").show();
                } else {
                    $("#nom_etab").hide();
                    $("#logo_etab").hide();
                }
            }

            function loadEtab(e) {
                if (e.value == 0) {
                    $('#last').show()
                } else {
                    $('#last').hide()
                }
            }

            function ar(e) {
                if (e.value == 0) {
                    $('#journal_ar').show()
                } else {
                    $('#journal_ar').hide()
                }
            }

            function fr(e) {
                if (e.value == 0) {
                    $('#journal_fr').show()
                } else {
                    $('#journal_fr').hide()
                }
            }

            var loadFile = function(event, lang) {
                if (lang == 'ar') {
                    var output = document.getElementById('img_ar');
                } else {
                    var output = document.getElementById('img_fr');
                }
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
        </script>
    @endif

@endsection
