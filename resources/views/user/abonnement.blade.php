@extends('layouts.profile')

@section('title', 'Mes Abonnements')


@section('link_abonnement', 'text-info')

@section('profile')
    <div class="container-fluid">
        <h5 class="mb-4">Mes Abonnements</h5>
        @if ($current)
            <small>   
                <div>
                    Abonnement Choisi: <b> {{ $current->nom_abonnement }} </b>
                    <div class="row justify-content-center">
                        <div class=" col-md-4 col-sm-6 p-2 ">
                            @switch($current->nom_abonnement)
                                @case('bronze')
                                    <div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
                                        <div class="bg-orange mb-3 rounded-top" style="height: 6px"></div>
                                        <div class="text-center bold">Pack de bronze</div>
                                        <div class="h1 text-center text-green my-4">
                                            <span>11000</span> DZD/an
                                        </div>
                                        <div class="my-2">
                                            <ul class="">
                                                <li>Choisissez 1 secteur</li>
                                                <li>Toutes les fonctionnalités énumérées ci-dessus</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @break
                                @case('silver')
                                    <div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
                                        <div class="bg-light-gray mb-3 rounded-top" style="height: 6px"></div>
                                        <div class="text-center bold">pack Silver</div>
                                        <div class="h1 text-center text-green my-4">
                                            <span>17000</span> DZD/an
                                        </div>
                                        <div class="my-2">
                                            <ul class="">
                                                <li>Choisissez 3 secteurs</li>
                                                <li>Toutes les fonctionnalités énumérées ci-dessus</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @break
                                @case('gold')
                                    <div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
                                        <div class="bg-yellow mb-3 rounded-top" style="height: 6px"></div>
                                        <div class="text-center bold">Pack gold</div>
                                        <div class="h1 text-center text-green my-4">
                                            <span>24000</span> DZD/an
                                        </div>
                                        <div class="my-2">
                                            <ul class="">
                                                <li>Choisissez 6 secteurs </li>
                                                <li>Toutes les fonctionnalités énumérées ci-dessus</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @break
                                @case('platine')
                                    <div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
                                        <div class="bg-red mb-3 rounded-top" style="height: 6px"></div>
                                        <div class="text-center bold">pack platine</div>
                                        <div class="h1 text-center text-green my-4">
                                            <span>28000</span> DZD/an
                                        </div>
                                        <div class="my-2">
                                            <ul class="">
                                                <li>Choisissez 10 secteurs</li>
                                                <li>Toutes les fonctionnalités énumérées ci-dessus</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @break
                                @case('ultra')
                                    <div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
                                        <div class="bg-blue mb-3 rounded-top" style="height: 6px"></div>
                                        <div class="text-center bold">pack ultra</div>
                                        <div class="h1 text-center text-green my-4">
                                            <span>34000</span> DZD/an
                                        </div>
                                        <div class="my-2">
                                            <ul class="">
                                                <li>Touts les secteurs</li>
                                                <li>Toutes les fonctionnalités énumérées ci-dessus</li>
                                                <li>Assistance juridique</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @break
                                @case('gratuit')
                                @default
                                    <div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
                                        <div class="bg-light-gray mb-3 rounded-top" style="height: 6px"></div>
                                        <div class="text-center bold">Forfait gratuit à vie</div>
                                        <div class="h1 text-center text-green my-4">0.00 DZD</div>
                                        <div class="my-2">
                                            <ul class="">
                                                <li>Découvrez le site pendant une période illimitée sans passer en revue tous les détails</li>
                                                <li>Sélection illimitée de secteurs</li>
                                            </ul>
                                        </div>
                                      
                                    </div>
                            @endswitch
                        </div>
                    </div>
                    
                </div>
                secteurs selectionné:
                
                <ul class="my-2">
                    @if ($secteurs)
                        @foreach ($secteurs as $sect)
                            <li>{{ $sect->secteur }}</li>
                        @endforeach                        
                    @endif
                </ul>

                <div class="d-flex justify-content-between">
                    <div>
                        <div class="mb-2">
                            Debut de l'abonnement
                        </div>
                        <div class="mb-2">
                            {{ $current->date_debut }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="mb-2">
                            Fin de l'abonnement
                        </div>
                        <div class="mb-2">
                            {{ $current->date_fin }}
                        </div>
                    </div>
                </div>
                <div class="progress" style="border-radius: 20px">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </small>
        @else
            <div class="display-3">Aucune Abonnement en cours</div>
        @endif
        

        <div class="my-4">
            <h5>Historique de mes abonnements</h5>
            <small>
                <table class="table table-sm">
                    <tr>
                        <td>Type d'abonnement</td>
                        <td>Date debut</td>
                        <td>Date fin</td>
                    </tr>
                    <tbody class="bg-light">
                        @foreach (Auth::user()->abonnement as $abon)
                            <tr>
                                <td>{{ $abon->nom_abonnement }}</td>
                                <td>{{ $abon->date_debut }}</td>
                                <td>{{ $abon->date_fin }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </small>

        </div>
    </div>
@endsection