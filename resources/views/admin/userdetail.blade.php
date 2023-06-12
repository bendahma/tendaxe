@extends('layouts.panel')

@section('title', 'user detail')

@section('content')

    @if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            {{ session('success') }}
        </div>
    </div>
    @endif

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

    <div class="bg-white p-3">
        {{-- etab infos --}}
        @if ($etab)
            <h4>Etablissement</h4>
            @if ($etab->logo)
                <img class="rounded-circle" width="120px" src="{{ asset('storage/logo/'.$etab->logo) }}" alt="">
            @endif
            <ul>
                <li>nom etablissement : {{ "$etab->nom_etablissement" }}</li>
                <li>category : {{ "$etab->category" }}</li>
                <li>emplacement : {{ "wilaya $etab->wilaya , commune $etab->commune" }}</li>
                
            </ul>
            autre infos:
            <ul>
                @if ($etab->fax)
                    <li>fax : {{ $etab->fax }}</li>
                @endif
                @if ($etab->fix)
                    <li>fix : {{ $etab->fix }}</li>
                @endif
                @if ($etab->email)
                    <li>email ou site : {{ $etab->email }}</li>
                @endif
            </ul>
            <hr>
        @endif
        
        {{-- etat --}}
        <h4>Etat compte</h4>
        <form action="{{ route('admin.user.etat', $user) }}" method="POST" class="row">
            @csrf
            <div class="col-6">
                <select class="form-control selectpicker" name="etat" id="">
                    <option value="active" {{ ($user->etat === "active") ? "selected" : "" }} >active</option>
                    <option value="desactive" {{ ($user->etat === "desactive") ? "selected" : "" }} >desactive</option>
                </select>
            </div>
            <div class="col-6">
                <button class="btn btn-info">Changé etat</button>
            </div>
        </form>
        
        <hr>

        <h4>Etat email verification</h4>
        <form action="{{ route('admin.user.email', $user) }}" method="POST" class="row">
            @csrf
            <div class="col-md-6">
                <select class="form-control selectpicker" name="verification" >
                    <option value="on" {{ ($user->email_verified_at) ?? 'selected' }}>On</option>
                    <option value="off" {{ (!$user->email_verified_at) ? 'selected' : '' }}>Off</option>
                </select>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-info">Changer</button>
            </div>
        </form>
        <hr>
        {{-- user infos --}}
        <h4>Utilisateur</h4>
        <form action="{{ route('admin.user.details', $user) }}" method="POST">
            @csrf
            <div class="row my-3" style="max-width: 600px;">
                <div class="col-4 mb-3">
                    <label for="">Nom</label>
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="text" name="nom" placeholder="{{ $user->nom }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Prenom</label>
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="text" name="prenom" placeholder="{{ $user->prenom }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Email</label>
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="email" name="email" placeholder="{{ $user->email }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Telephone</label>
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="text" name="phone" placeholder="{{ $user->phone }}">
                </div>
                @if ($user->type_user === "abonné")
                    <div class="col-4 mb-3">
                        <label for="">Entreprise</label>
                    </div>
                    <div class="col-8 mb-3">
                        <input class="form-control" type="text" name="nom_entreprise" placeholder="{{ $user->nom_entreprise }}">
                    </div>
                @endif
                <div class="col-4 mb-3">
                    <label for="">Wilaya</label>
                </div>
                <div class="col-8 mb-3">
                    <select class="wil1 form-control selectpicker" data-live-search="true" name="wilaya" id="user-wilaya"></select>
                </div>
                <div class="col-4 mb-3">
                    <label for="">Commentaire</label>
                </div>
                <div class="col-8 mb-3">
                    <textarea name="note" class="form-control" rows="3">{{ $user->note }}</textarea>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-info">Modifier</button>
            </div>
        </form>

        <hr>

        {{-- reset password --}}
        <h4>Mot de Passe</h4>
        <form action="{{ route('admin.user.password', $user) }}" method="POST">
            @csrf
            <div class="row my-3" style="max-width: 600px;">
                <div class="col-4 mb-3">
                    Nouveau mot de passe
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="col-4 mb-3">
                    Repetez mot de passe
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-info">Changer</button>
            </div>
        </form>

        @if ($user->type_user === "abonné")
            <hr>
            <h4>Nouvel Abonnement</h4>
            @if ($user->pending_abonnement)
                <form action="{{ route('admin.abonnement.edit') }}" method="POST">
                    @csrf
                    <input type="number" name="abonnement_id" value="{{ $user->pending_abonnement->id }}" hidden>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Abonnement choisi</label>
                            <select class="form-control selectpicker" name="nom_abonnement" onchange="abonnement_check(this, 'new')" id="">
                                <option value="bronze" {{ ($user->pending_abonnement->nom_abonnement === 'bronze') ? 'selected' : '' }}>Bronze</option>
                                <option value="silver" {{ ($user->pending_abonnement->nom_abonnement === 'silver') ? 'selected' : '' }}>Silver</option>
                                <option value="gold" {{ ($user->pending_abonnement->nom_abonnement === 'gold') ? 'selected' : '' }}>Gold</option>
                                <option value="platine" {{ ($user->pending_abonnement->nom_abonnement === 'platine') ? 'selected' : '' }}>Platine</option>
                                <option value="ultra" {{ ($user->pending_abonnement->nom_abonnement === 'ultra') ? 'selected' : '' }}>Ultra</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Secteurs</label>
                            <select name="secteurs[]" class="form-control mb-2 selectpicker" multiple title="Secteur" data-live-search="true" id="new_sec" required>
                                @foreach (App\Models\Secteur::All() as $sect)
                                    <option value="{{ $sect->id }}" {{ ($user->pending_abonnement->secteur->contains($sect)) ? 'selected' : '' }} data-tokens="{{ $sect->secteur }}">{{ $sect->secteur }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date debut</label>
                            <input class="form-control" type="date" name="date_debut" value="{{ $date_debut }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date fin</label>
                            <input class="form-control" type="date" name="date_fin" value="{{ date('Y-m-d', strtotime($date_debut . ' +1 years')) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Nombre d'utilisateurs</label>
                            <input class="form-control" type="number" name="session_limit" min="1" value="1">
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info">Renouvlé</button>
                    </div>
                </form>
            @else
                <form action="{{ route('admin.abonnement.store', $user) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Abonnement choisi</label>
                            <select class="form-control selectpicker" name="nom_abonnement" onchange="abonnement_check(this, 'new')" id="">
                                <option value="gratuit">gratuit</option>
                                <option value="bronze" selected>Bronze</option>
                                <option value="silver">Silver</option>
                                <option value="gold">Gold</option>
                                <option value="platine">Platine</option>
                                <option value="ultra">Ultra</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Secteurs</label>
                            <select name="secteurs[]" class="form-control mb-2 selectpicker" multiple title="Secteur" data-live-search="true" id="new_sec" required>
                                @foreach (App\Models\Secteur::All() as $sect)
                                    <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}">{{ $sect->secteur }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date debut</label>
                            <input class="form-control" type="date" name="date_debut" value="{{ $date_debut }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date fin</label>
                            <input class="form-control" type="date" name="date_fin" value="{{ date('Y-m-d', strtotime($date_debut . ' +1 years')) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Nombre d'utilisateurs</label>
                            <input class="form-control" type="number" name="session_limit" min="1" value="1">
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info">Renouvlé</button>
                    </div>
                </form>
            @endif

            <hr>

            <h4>Historique d'abonnement</h4>
            <table class="table">
                <tr>
                    <td>Nom Abonnement</td>
                    <td>Date debut</td>
                    <td>Date fin</td>
                    <td>Action</td>
                </tr>
                @foreach ($user->abonnement as $abonnement)
                    <tr>
                        <td>{{ $abonnement->nom_abonnement }}</td>
                        <td>{{ $abonnement->date_debut }}</td>
                        <td>{{ $abonnement->date_fin }}</td>
                        <td>
                            @if ($abonnement->nom_abonnement !== "gratuit")
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $abonnement->id }}">Supprimer</a>
                            @endif
                            @if (new DateTime($abonnement->date_fin) >= new DateTime())
                                <button class="btn btn-warning" data-id="{{ $abonnement->id }}" onclick="edit_abonnement(this)">Edit</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="collapse" id="edit_form">
                <hr>
                <h4>Modifier Abonnement</h4>

                <form id="form_reset" action="{{ route('admin.abonnement.edit') }}" method="POST">
                    @csrf
                    <input id="abonnement_id" type="number" name="abonnement_id" hidden>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Abonnement choisi</label>
                            <select class="form-control selectpicker" name="nom_abonnement" onchange="abonnement_check(this, 'old')" id="nom_abonnement">
                                <option value="bronze">Bronze</option>
                                <option value="silver">Silver</option>
                                <option value="gold">Gold</option>
                                <option value="platine">Platine</option>
                                <option value="ultra">Ultra</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Secteurs</label>
                            <select name="secteurs[]" class="form-control mb-2" multiple title="Secteur" data-live-search="true" id="secteurs">
                                @foreach (App\Models\Secteur::All() as $sect)
                                    <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}">{{ $sect->secteur }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date debut</label>
                            <input id="date_debut" class="form-control" type="date" name="date_debut" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date fin</label>
                            <input id="date_fin" class="form-control" type="date" name="date_fin" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Nombre d'utilisateurs</label>
                            <input class="form-control" type="number" name="session_limit" id="session_limit" min="1">
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info">Modifier</button>
                        <a class="btn btn-secondary" data-toggle="collapse" href="#edit_form" role="button" aria-expanded="false" aria-controls="edit_form">Annuler</a>
                    </div>

                </form>
            </div>

            <hr>

            <h4>Notification</h4>
            <form action="{{ route('admin.notif', $notif) }}" method="POST">
                @csrf
                {{-- frequence --}}
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="mt-2">Etat</h6>
                    </div>
                    <div class="col-md-9 d-flex justify-content-between">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="frequence" id="inlineRadio1" checked value="none">
                            <label class="form-check-label" for="inlineRadio1">Desactivé</label>
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
                        <label for="">Mots clés</label>
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
                        <select class="form-control selectpicker" multiple data-live-search="true" name="secteur[]" id="">
                            {{-- get user secteur --}}
                            @foreach (App\Models\Secteur::All() as $sect)
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
                        <select class="form-control wil1 selectpicker" multiple data-live-search="true" name="wilaya[]" id="notif-wilaya"></select>
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
                        <select name="statut[]" class="form-control mb-2 selectpicker" title="statut" data-live-search="true" multiple>
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

        @endif

    </div>

            <!-- delete modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Voulez vous supprimer cet Abonnement?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">non</button>
              <form method="POST" action="{{ route('admin.abonnement.destroy') }}">
                  @csrf
                  @method('DELETE')
                  <input type="number" name="abonnement" id="abonnement" hidden>
                  <button class="btn btn-info">Oui</button>
              </form>
            </div>
          </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#exampleModalCenter').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 

            $('#abonnement').val(id);
		});

        wilaya1();

        function edit_abonnement(e) {
            var id = $(e).data('id');
            // hide current form
            $("#edit_form").collapse('hide');

            $("#form_reset").trigger("reset");
            
            // get the date
            $.get("/admin/abonnement/"+id, function(data, status){
                if(status === 'success'){
                    // fill the form
                    $('#abonnement_id').val(data.id);
                    $('#nom_abonnement').val(data.nom_abonnement);
                    $('#nom_abonnement').selectpicker('refresh');
                    $('#date_debut').val(data.date_debut);
                    $('#date_fin').val(data.date_fin);
                    $('#session_limit').val(data.session_limit);
                    
                    var secteur = [];
                    for(var k in data.secteur){
                        secteur.push(data.secteur[k].id);
                    }
                    $('#secteurs').val(secteur);
                    $('#secteurs').selectpicker();

                    $("#edit_form").collapse('show');
                }
            });            

        }

        function abonnement_check(e, type) {
            console.log(e.value);
            if(type === 'new'){
                var target = $('#new_sec');
                var target_select = $('#new_sec option');
            }else{
                var target = $('#secteurs');
                var target_select = $('#secteurs option');
            }

            if(e.value === "gratuit" || e.value === 'ultra'){
                // select all secteurs 
                target_select.prop("selected", "selected");
                target.selectpicker('refresh');

            }else{
                // deselect all 
                target_select.prop("selected", false);
                target.selectpicker('refresh');

            }
        }

        $("#notif-wilaya option[value='Aucun']").remove();

        function sect(e) {
            var id = e.data('id'); 
            var url = "/admin/notif/sect/"+ {{ $user->id }} + "/" + id;
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

    @if ($user->wilaya)
        <script>
            $("#user-wilaya").val("{{ $user->wilaya }}");
        </script>
    @endif
@endsection