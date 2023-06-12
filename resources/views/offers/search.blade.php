@extends('layouts.layout')

@section('title', 'Offres')
    
@section('content')
    <div class="container-fluid px-md-5 py-5" style="background: url({{ asset('img/banner/books.jpg') }}) no-repeat center center; margin-top: 66px; background-size: cover;">
        <div class="">
            <h3 class="text-white bold my-4">Liste d'annonces</h3>
        </div>
    </div>
    <div class="container-lg">
        <x-alert />
        <div class="mt-3 mb-2 text-right">
            @auth
                <a href="{{ route('offre.add') }}" class="btn btn-sm btn-primary px-3 font-weight-600">Ajouter Offre</a>
            @endauth
            @guest
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary px-3 font-weight-600">Ajouter Offre</a>
            @endguest
        </div>
        <div class="row">
            <div class="col-md-3 pr-md-1">
                <form class="bg-white p-2 border rounded mt-2 hide-md" method="GET" action="{{ route('search') }}">
                    {{-- <div class="form-group">
                        <input class="form-control bg-light" type="text" name="keyword" placeholder="mot clé">
                    </div> --}}
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-light" style="font-size: small" placeholder="Mot clé" name="keyword" value="{{ old('keyword') }}">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-sm btn-primary" type="button" id="button-addon2">
                              <img src="{{ asset('img/icons/search2.png') }}" alt="">
                          </button>
                        </div>
                      </div>
                      
                    <select name="wilaya[]" class="form-control mb-2 wil1 selectpicker" multiple data-style="btn-white border" data-size="5" title="Toutes les wilayas">
                    </select>
                    <select name="statut[]" class="form-control mb-2 selectpicker" multiple data-style="btn-white border" title="statut" data-size="6">
                        <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation" {{ (old('statut') && in_array('Appel d\'offres & Consultation', old('statut'))) ? 'selected':''  }}>Appel d'offres & Consultation</option>
                        <option value="Attribution de marché" data-tokens="Attribution de marché" {{ (old('statut') && in_array('Attribution de marché', old('statut'))) ? 'selected':''  }}>Attribution de marché</option>
                        <option {{ (old('statut') && in_array('Sous-traitance', old('statut'))) ? 'selected':''  }} value="Sous-traitance" data-tokens="Sous-traitance">Sous-traitance</option>
                        <option {{ (old('statut') && in_array('Prorogation de délai', old('statut'))) ? 'selected':''  }} value="Prorogation de délai" data-tokens="Prorogation de délai">Prorogation de délai</option>
                        <option {{ (old('statut') && in_array('Annulation', old('statut'))) ? 'selected':''  }} value="Annulation" data-tokens="Annulation">Annulation</option>
                        <option {{ (old('statut') && in_array('Infructuosité', old('statut'))) ? 'selected':''  }} value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                        <option {{ (old('statut') && in_array('Adjudication', old('statut'))) ? 'selected':''  }} value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                        <option {{ (old('statut') && in_array('Vente aux enchères', old('statut'))) ? 'selected':''  }} value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux enchères</option>
                        <option {{ (old('statut') && in_array('Mise en demeure et résiliation', old('statut'))) ? 'selected':''  }} value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation">Mise en demeure et résiliation</option>
                    </select>
                    <select name="secteur[]" class="form-control mb-2 selectpicker" data-dropup-auto="false" data-style="btn-white border" multiple title="Secteur" data-size="6">
                        @if ($secteurs)
                            @foreach ($secteurs as $sect)
                                <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" {{ (old('secteur') && in_array($sect->id, old('secteur'))) ? 'selected':''  }} >{{ $sect->secteur }} >{{ $sect->secteur }}</option>
                            @endforeach
                        @endif                       
                    </select>
                    <select name="type" class="form-control mb-2 selectpicker"data-style="btn-white border" title="Type">
                        <option value="national" data-tokens="national" {{ (old('type') === 'national') ? 'selected' : '' }}>National</option>
                        <option value="international" data-tokens="national et international" {{ (old('type') === 'international') ? 'selected' : '' }}>National & International</option>
                    </select>
                    <div class="form-group mb-2">
                        <input class="bg-light form-control" type="text" style="font-size: small" name="annonceur" placeholder="Annonceur" value="{{ old('annonceur') }}">
                    </div>
                    
                    <select class="form-control mb-2 selectpicker" onchange="customDate(this, 'pub')" name="pub" title="Date de publication" data-live-search="false">
                        <option value="today">Ajourdhui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="custom">Personalisé</option>
                    </select>

                    <div class="collapse mb-2" id="pub">
                        <input class="form-control" type="date" name="custom_pub">
                    </div>
                      
                    <select class="form-control mb-2 selectpicker" onchange="customDate(this, 'limit')" name="limit" title="Date limit" data-live-search="false">
                        <option value="today">Ajourdhui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="custom">Personalisé</option>
                    </select>

                    <div class="collapse mb-2" id="limit">
                        <input class="form-control" type="date" name="custom_limit">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Rechercher</button>

                </form>
                <div class="show-md mx-2">
                    <hr>

                    <h4 class="text-center bold">Filtres</h4>
                    <p class="text-muted text-center">
                        Selectionnez les annonces qui vous convient selon le secteur d’activite, wilaya, statue, annonceur et la date de publication.
                    </p>
                    <button id="collapse_button" class="btn btn-primary w-100 font-weight-600" type="button" data-toggle="collapse" data-target="#mobile_filter" aria-expanded="false" aria-controls="mobile_filter">Afficher les filtres</button>
                    <hr>

                    <div class="collapse" id="mobile_filter">
                        <form class="bg-white p-2 border rounded mt-2" method="GET" action="{{ route('search') }}">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control bg-light" style="font-size: small" placeholder="Mot clé" name="keyword" value="{{ old('keyword') }}">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-sm btn-primary" type="button" id="button-addon2">
                                      <img src="{{ asset('img/icons/search2.png') }}" alt="">
                                  </button>
                                </div>
                            </div>
                              
                            <select name="wilaya[]" class="form-control mb-2 wil1 selectpicker" multiple data-style="btn-white border" data-size="5" title="Toutes les wilayas">
                            </select>
                            <select name="statut[]" class="form-control mb-2 selectpicker" multiple data-style="btn-white border" title="statut" data-size="6">
                                <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation" {{ (old('statut') && in_array('Appel d\'offres & Consultation', old('statut'))) ? 'selected':''  }}>Appel d'offres & Consultation</option>
                                <option value="Attribution de marché" data-tokens="Attribution de marché" {{ (old('statut') && in_array('Attribution de marché', old('statut'))) ? 'selected':''  }}>Attribution de marché</option>
                                <option {{ (old('statut') && in_array('Sous-traitance', old('statut'))) ? 'selected':''  }} value="Sous-traitance" data-tokens="Sous-traitance">Sous-traitance</option>
                                <option {{ (old('statut') && in_array('Prorogation de délai', old('statut'))) ? 'selected':''  }} value="Prorogation de délai" data-tokens="Prorogation de délai">Prorogation de délai</option>
                                <option {{ (old('statut') && in_array('Annulation', old('statut'))) ? 'selected':''  }} value="Annulation" data-tokens="Annulation">Annulation</option>
                                <option {{ (old('statut') && in_array('Infructuosité', old('statut'))) ? 'selected':''  }} value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                                <option {{ (old('statut') && in_array('Adjudication', old('statut'))) ? 'selected':''  }} value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                                <option {{ (old('statut') && in_array('Vente aux enchères', old('statut'))) ? 'selected':''  }} value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux enchères</option>
                                <option {{ (old('statut') && in_array('Mise en demeure et résiliation', old('statut'))) ? 'selected':''  }} value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation">Mise en demeure et résiliation</option>
                            </select>
                            <select name="secteur[]" class="form-control mb-2 selectpicker" data-dropup-auto="false" data-style="btn-white border" multiple title="Secteur" data-size="6">
                                @if ($secteurs)
                                    @foreach ($secteurs as $sect)
                                        <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" {{ (old('secteur') && in_array($sect->id, old('secteur'))) ? 'selected':''  }} >{{ $sect->secteur }}</option>
                                    @endforeach
                                @endif                       
                            </select>
                            <select name="type" class="form-control mb-2 selectpicker"data-style="btn-white border" title="Type">
                                <option value="national" data-tokens="national">National</option>
                                <option value="international" data-tokens="national et international">National & International</option>
                            </select>
                            <div class="form-group mb-2">
                                <input class="bg-light form-control" type="text" style="font-size: small" name="annonceur" placeholder="Annonceur" value="{{ old('annonceur') }}">
                            </div>
                            
                            <select class="form-control mb-2 selectpicker" onchange="customDate(this, 'pub_mob')" name="pub" title="Date de publication" data-live-search="false">
                                <option value="today">Ajourdhui</option>
                                <option value="week">Cette semaine</option>
                                <option value="month">Ce mois</option>
                                <option value="custom">Personalisé</option>
                            </select>
        
                            <div class="collapse mb-2" id="pub_mob">
                                <input class="form-control" type="date" name="custom_pub">
                            </div>
                              
                            <select class="form-control mb-2 selectpicker" onchange="customDate(this, 'limit_mob')" name="limit" title="Date limit" data-live-search="false">
                                <option value="today">Ajourdhui</option>
                                <option value="week">Cette semaine</option>
                                <option value="month">Ce mois</option>
                                <option value="custom">Personalisé</option>
                            </select>
        
                            <div class="collapse mb-2" id="limit_mob">
                                <input class="form-control" type="date" name="custom_limit">
                            </div>
        
                            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
        
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-9 pl-md-1">
                @if ($offres->count())
                    @foreach ($offres as $offre)
                        <x-offre :exp="$expired" :offre="$offre" />
                    @endforeach
                @else
                    <h3 class="text-center">Pas de resultat</h3>
                @endif
                <div class="mt-5">
                    {{ $offres->links() }}
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        wilaya1();
        $(".wil1 option[value='Aucun']").remove();
        $(".wil1").selectpicker('refresh');

        function customDate(e, type) {

            var target = $('#'+type);

            if(e.value === 'custom'){
                target.collapse('show');
            }else{
                target.collapse('hide');
            }
        }

        $('#mobile_filter').on('hide.bs.collapse', function () {
            $('#collapse_button').html('Afficher les filtres');
        });

        $('#mobile_filter').on('show.bs.collapse', function () {
            $('#collapse_button').html('Masquer les filtres');
        });
    </script>

    @if (old('wilaya'))
        <script>
            var wilayas = @json(old('wilaya'));
            $('.wil1').val(wilayas).selectpicker('refresh');
        </script>
    @endif
@endsection