@props(['offre' => $offre, 'expired' => $exp])

<div class="my-2">
    <div class="bg-white px-3 pt-3 border rounded">
        @if ($offre->etat === 'pending')
            <div class="text-center">
                <span class="badge bg-secondary">en attente</span>
            </div>
        @endif
        <div class="row">
            <div class="col-9 col-md-10 font-weight-600">
               {{ $offre->titre }}
            </div>
            <div class="col-3 col-md-2 text-right">
                @if ($expired)
                    <img class="" src="{{ asset('img/icons/lock2.png') }}" width="50px">
                @else
                    @if ($offre->adminetab->category !== "AUTRE")
                        <img class="" src="{{ asset('img/1.png') }}" width="50px">
                    @else
                        <img class="rounded-circle" src="{{ asset('storage/logo/'.$offre->adminetab->logo) }}" width="50px">
                    @endif
                @endif

            </div>
        </div>
            <div class="mt-3 mt-md-2" style="font-size: 88%;">
                <div class="mb-2">
                    <span class="font-weight-600">Annonceur: </span>
                    @if ($expired)
                        <img src="{{ asset('img/icons/lock.png') }}">
                        Réservé aux abonnés
                    @else
                        {{ $offre->adminetab->nom_etablissement }}   
                    @endif
                </div>
                <div class="mb-2">
                    <span class="font-weight-600">Statut: </span>
                    {{ $offre->statut }}
                </div>
                @if ($offre->wilaya)
                    <div class="mb-2">
                        <span class="font-weight-600">Wilaya: </span>
                        @if ($expired)
                            <img src="{{ asset('img/icons/lock.png') }}">
                            Réservé aux abonnés
                        @else
                            {{ $offre->wilaya }}
                        @endif
                    </div>
                @endif

            </div>
            <div class="mb-2 d-flex">
                <span class="mx-auto mt-2 text-15"> <img src="{{ asset('img/icons/play.png') }}"> {{ $offre->date_pub }}</span>
                <span class="mx-auto mt-2 text-15"> <img src="{{ asset('img/icons/stop.png') }}"> {{ $offre->date_limit }}</span>
                <div>
                    <a href="{{ route('detail', $offre) }}" class="btn btn-sm btn-primary px-3 ml-auto">Detail</a>
                    @if (Auth::check() && Auth::user()->type_user === 'content')
                        <a href="{{ route('rep.offers.edit', $offre) }}" class="btn btn-sm btn btn-outline-info">Modifier</a>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $offre->id }}">Supprimer</button>
                    @endif
                    @if (Auth::check() && (Auth::user()->type_user === 'admin' || Auth::user()->type_user === 'publisher'))
                        <a href="{{ route('admin.offers.edit', $offre) }}" class="btn btn-sm btn btn-outline-info">Modifier</a>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $offre->id }}">Supprimer</button>
                    @endif
                    @if (Auth::check() && Auth::user()->type_user === 'admin' && $offre->trashed())
                        <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#restoremodal" data-id="{{ $offre->id }}">Restore</button>
                    @endif
                    @if (Auth::check() && Auth::user()->type_user === 'admin' && $offre->etat === "pending")
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptmodal" data-id="{{ $offre->id }}">accepter</button>
                    @endif
                </div>
            </div>
        
    </div>
</div>