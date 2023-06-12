@extends('layouts.profile')

@section('link_profile', 'text-info')

@section('profile')
    <div class="container-fluid">
        <h5 class="mb-4">Modifier mon profile</h5>
        <ul class="pl-3" style="list-style: none;">
            <li class="mb-2">Nom: 
                <span class="ml-3 bold">{{ Auth::user()->nom }}</span>
            </li>
            <li class="mb-2">Prenom: 
                <span class="ml-3 bold">{{ Auth::user()->prenom }}</span>
            </li>
            <li class="mb-2">Email: 
                <span class="ml-3 bold">{{ Auth::user()->email }}
                    <a href="" data-toggle="modal" data-target="#mail">
                        <img class="ml-4" src="{{ asset('img/icons/edit.png') }}" alt="">
                    </a>
                </span>
            </li>
            <li class="mb-2">Telephone: 
                <span class="ml-3 bold">{{ Auth::user()->phone }}
                    <a href="" data-toggle="modal" data-target="#phone">
                        <img class="ml-4" src="{{ asset('img/icons/edit.png') }}" alt="">
                    </a>
                </span>
            </li>
            <li class="mb-2">Nom de l'entreprise: 
                <span class="ml-3 bold">{{ Auth::user()->nom_entreprise }}</span>
            </li>
            <li class="mb-2">Wilaya: 
                <span class="ml-3 bold">{{ Auth::user()->wilaya }}</span>
            </li>
        </ul>

        <form action="{{ route('user.password') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Mot de passe actuel</label>
                <input class="form-control form-control-sm bg-light" type="password" name="old_password">
            </div>
            <div class="form-group">
                <label for="">Nouveau mot de passe</label>
                <input class="form-control form-control-sm bg-light" type="password" name="password">
            </div>
            <div class="form-group">
                <label for="">Confirmer Nouveau mot de passe</label>
                <input class="form-control form-control-sm bg-light" type="password" name="password_confirmtaion">
            </div>
            <div class="text-right">
                <button class="btn btn-primary">Modifier</button>
            </div>
        </form>

    </div>

    {{-- edit email modal --}}

    <div class="modal fade" id="mail" tabindex="-1" role="dialog" aria-labelledby="mailTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="mailTitle">Modifier Email</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('user.email') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="">Nouveau Email</label>
                    <input class="form-control" type="email" name="email" id="" placeholder="{{ Auth::user()->email }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary">Modifier</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    {{-- edit phone modal --}}

    <div class="modal fade" id="phone" tabindex="-1" role="dialog" aria-labelledby="phoneTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="phoneTitle">Changer Numero Telephone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('user.phone') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="">Nouveau numero telephone</label>
                    <input class="form-control" type="text" required name="phone" placeholder="{{ Auth::user()->phone }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary">Modifier</button>
                </div>
            </form>
          </div>
        </div>
    </div>

@endsection