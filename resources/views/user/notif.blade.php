@extends('layouts.profile')

@section('title', 'Notifications')

@section('link_notif', 'text-info')

@section('profile')
    <div class="container-fluid">
        <h5>Notifications</h5>
        <p>Paramétrez vos alertes mails afin de recevoir uniquement les publications qui vous intéressent !</p>

        @if (Auth::user()->current_abonnement)
            <form action="{{ route('user.notif') }}" method="POST">
                @csrf
                {{-- frequence --}}
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="mt-2">Etat</h6>
                    </div>
                    <div class="col-md-9 d-flex justify-content-between">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="frequence" id="inlineRadio1" checked value="none">
                            <label class="form-check-label" for="inlineRadio1">Desactive</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="frequence" id="inlineRadio2" {{ ($notif->frequence === 'everyday') ? 'checked' : '' }} value="everyday">
                            <label class="form-check-label" for="inlineRadio2">Active</label>
                        </div>
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="frequence" id="inlineRadio3" {{ ($notif->frequence === 'weekly') ? 'checked' : '' }} value="weekly">
                            <label class="form-check-label" for="inlineRadio3">Hebdomadaire</label>
                        </div>                   --}}
                    </div>
                </div>

                <hr>

                {{-- keyword --}}
                <div class="row">
                    <div class="col-md-4">
                        <label class="font-weight-500" for="">Mots clés</label>
                        <input class="form-control bg-light" type="text" name="keyword">
                    </div>
                    <div class="col-md-8">
                        @if ($notif->keyword)
                            <ul class="pl-3" style="list-style: none;">
                                {{-- display notif keywords --}}
                                @foreach ($notif->keyword as $item)
                                    <li>
                                        <button type="button" data-id="{{ $item->id }}" class="p-0" onclick="keyword2($(this))" style="border: none; background: none;">
                                            <img class="" src="{{ asset('img/icons/delete.png') }}" alt="">
                                        </button>
                                        <span class="mr-2">
                                            {{ $item->keyword }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <hr>

                {{-- secteurs --}}
                <div class="row">
                    <div class="col-md-4">
                        <label class="font-weight-500" for="">Secteurs</label>
                        <select class="form-control selectpicker" multiple data-live-search="true" name="secteur[]" id="">
                            {{-- get user secteur --}}
                            @foreach (Auth::user()->current_abonnement->secteur as $sect)
                                <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" >{{ $sect->secteur }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        @if ($notif->secteur)
                            <ul class="pl-3" style="list-style: none;">
                                {{-- display notif secteurs --}}
                                @foreach ($notif->secteur as $item)
                                    <li>
                                        <button type="button" data-id="{{ $item->id }}" onclick="sect($(this))" class="p-0" style="border: none; background: none;">
                                            <img class="" src="{{ asset('img/icons/delete.png') }}" alt="">
                                        </button>
                                        <span class="mr-2">
                                            {{ $item->secteur }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <hr>

                {{-- wilaya --}}
                <div class="row">
                    <div class="col-md-4">
                        <label class="font-weight-500" for="">Wilaya</label>
                        <select class="form-control wil1 selectpicker" multiple data-live-search="true" name="wilaya[]" id=""></select>
                    </div>
                    <div class="col-md-8">
                        @if ($notif->wilaya)
                            <ul class="pl-3" style="list-style: none;">
                                @foreach ($notif->wilaya as $item)
                                    <li>
                                        <button type="button" class="p-0" data-id="{{ $item->id }}" onclick="wilaya($(this))" style="border: none; background: none;">
                                            <img class="" src="{{ asset('img/icons/delete.png') }}" alt="">
                                        </button>
                                        <span class="mr-2">
                                            {{ $item->wilaya }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <label class="font-weight-500" for="">Statuts</label>
                        <select name="statut[]" class="form-control mb-2 selectpicker" multiple title="statut" data-live-search="true">
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
                    <div class="col-md-8">
                        @if ($notif->statut)
                            <ul class="pl-3" style="list-style: none;">
                                @foreach ($notif->statut as $item)
                                    <li>
                                        <button type="button" class="p-0" data-id="{{ $item->id }}" onclick="statut($(this))" style="border: none; background: none;">
                                            <img class="" src="{{ asset('img/icons/delete.png') }}" alt="">
                                        </button>
                                        <span class="mr-2">
                                            {{ $item->statut }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="text-right">
                    <button class="btn btn-primary px-4">Appliquer</button>
                </div>
            </form>
        @else
            <h2 class="text-center">Aucune abonnement active</h2>
        @endif
        
    </div>

    <script>
        wilaya1();

        $(".wil1 option[value='Aucun']").remove();

        function sect(e) {
            var id = e.data('id'); 
            var url = "/settings/notif/sect/" + id;
            // send delete request 
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token" : "{{ csrf_token() }}"
                },
                success: function(status) {
                    // Do something with the result
                    if(status === 'success'){
                        e.parent('li').remove();
                    }
                }
            });

        }

        function keyword2(e) {
            var id = e.data('id'); 
            var url = "/settings/notif/keyword/" + id;
            // send delete request 
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token" : "{{ csrf_token() }}"
                },
                success: function(status) {
                    // Do something with the result
                    if(status === 'success'){
                        e.parent('li').remove();
                    }
                }
            });
        }

        function wilaya(e) {
            var id = e.data('id'); 
            var url = "/settings/notif/wilaya/" + id;
            // send delete request 
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token" : "{{ csrf_token() }}"
                },
                success: function(status) {
                    // Do something with the result
                    if(status === 'success'){
                        e.parent('li').remove();
                    }
                }
            });
        }

        function statut(e) {
            var id = e.data('id'); 
            var url = "/settings/notif/statut/" + id;
            // send delete request 
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token" : "{{ csrf_token() }}"
                },
                success: function(status) {
                    // Do something with the result
                    if(status === 'success'){
                        e.parent('li').remove();
                    }
                }
            });
        }

    </script>
@endsection