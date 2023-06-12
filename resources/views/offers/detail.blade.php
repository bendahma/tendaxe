@extends('layouts.layout')

@section('title', $offre->titre)
    
@section('content')
<div class="container-lg main">
    <x-alert />

    <div class="row pt-4 mb-4">
        <div class="offset-sm-3 pr-3 pr-md-0 col-sm-8 col-10">
            <h4 class="font-weight-600 text-dark text-22" style="">{{ $offre->titre }}</h4>
        </div>
        @auth
        @if (!$expired)
            <form class="col-1" method="POST" action="{{ route('favorit.toggle', $offre) }}">
                @csrf
                @if ($offre->isFavorited())
                    <button class="text-sm-right" style="background: none; border: none;">
                        <img src="{{ asset('img/icons/starfill.png') }}">
                    </button>
                @else
                    <button class="text-sm-right" style="background: none; border: none;">
                        <img src="{{ asset('img/icons/star.png') }}">
                    </button>
                @endif
            </form>
        @endif
        @endauth
    </div>
    <hr class="show-md">
    <div class="row pt-4 pt-md-2">
        <div class="col-md-3 border-right">
            <div class="text-center">
                <h6 class="bold mb-4">Infos d’annonceur:</h6>
                @if ($expired)
                    <img class="img-fluid mb-4" src="{{ asset('img/icons/lock3.png') }}">
                    <h6 class="bold mb-4">Réservé aux abonnés</h6>
                @else
                    @if($img === "default")
                        <img class="img-fluid mb-4" src="{{ asset('img/2.png') }}">
                        <h6 class="bold mb-3">{{ $etab->nom_etablissement }}</h6>
                    @elseif ($img)
                    <img class="img-fluid mb-4 rounded-circle" src="{{ asset('storage/logo/' . $img) }}">
                    <h6 class="bold mb-3">{{ $etab->nom_etablissement }}</h6>
                    @endif
                @endif
                @if (!$expired && $etab)
                    @if ($etab->fix)
                        <div class="mb-2">
                            <span class="font-weight-600">fix: </span>
                            {{ $etab->fix }}
                        </div>
                    @endif
                    @if ($etab->fax)
                        <div class="mb-2">
                            <span class="font-weight-600">fax: </span>
                            {{ $etab->fax }}
                        </div>
                    @endif
                    @if ($etab->email)
                        <div class="mb-2">
                            <span class="font-weight-600">Email ou siteweb: </span>
                            {{ $etab->email }}
                        </div>
                    @endif
                @endif
            </div>
            <hr>
            <div>
                <h6 class="text-center my-3 bold">Infos d’annonce</h6>
                <div class="mb-2">
                    <span class="font-weight-600">Identifiant: </span>
                    {{ $offre->id }}
                </div>
                <div class="mb-2">
                    <span class="font-weight-600">Statut: </span>
                    {{ $offre->statut }}
                </div>
                <div class="mb-2">
                    <span class="font-weight-600">Type: </span>
                    {{ $offre->type }}
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

                

                <div class="mb-2">
                    <b class="font-weight-600">Date publication:</b>  {{ $offre->date_pub }}
                </div>
                <div class="mb-2">
                    <b class="font-weight-600">Date d'échéance:</b>  {{ $offre->date_limit }}
                </div>
                <div class="mb-2">
                    <b class="font-weight-600">Secteur</b>
                    <ul class="pl-4 mt-2" style="">
                        @foreach ($offre->secteur as $item)
                            <li>{{ $item->secteur }}</li>
                        @endforeach                        
                    </ul>
                </div>
            </div>
            {{-- <div class="row pt-4 mb-4">
                <div class="col-10">
                    <h4 class="font-weight-600 h5 text-dark" style="">{{ $offre->titre }}</h4>
                </div>
                @auth
                @if (!$expired)
                <div class="col-2">
                    <form class="" method="POST" action="{{ route('favorit.toggle', $offre) }}">
                        @csrf
                        @if ($offre->isFavorited())
                            <button class="text-sm-right" style="background: none; border: none;">
                                <img src="{{ asset('img/icons/starfill.png') }}">
                            </button>
                        @else
                            <button class="text-sm-right" style="background: none; border: none;">
                                <img src="{{ asset('img/icons/star.png') }}">
                            </button>
                        @endif
                    </form>
                </div>
                @endif
                @endauth
            </div> --}}
        </div>
        <div class="col-md-9">
            
            <div class="">
                @if ($offre->statut === "Appel d'offres & Consultation")
                <hr class="mb-4 mt-0">
                    <div class="m-2">
                        <span>
                            <img class="mr-3" src="{{ asset('img/icons/indic.png') }}">
                            <b class="font-weight-600">Adress de retrait du cahier des charges: </b>

                            @if ($expired)
                                <img class="mx-2" src="{{ asset('img/icons/lock.png') }}">
                                Réservé aux abonnés
                            @else
                                bureau de marché de {{ $etab->nom_etablissement }}
                            @endif
                        </span>
                    </div>
                    @if ($offre->prix)
                    <div class="m-2">
                        <span>
                            <img class="mr-3" src="{{ asset('img/icons/dollar.png') }}">
                            <b>Prix d’cahier d’charge: </b>
                            @if ($expired)
                                <img class="mx-2" src="{{ asset('img/icons/lock.png') }}">
                                Réservé aux abonnés
                            @else
                                {{ $offre->prix . " Dzd" }}
                            @endif
                            
                        </span>
                    </div>
                    @endif
                    
                @endif
            </div>
            
            <hr class="mb-4 mt-0">


            @if (!$expired && $offre->description)
                <div class="my-4">
                    <p>
                        {!! nl2br(e($offre->description))!!}
                    </p>
                </div>
            @endif
            
            @if ($expired)
            <div class="my-4">
                <img class="img-fluid" src="{{ asset('img/exemple.png') }}">
            </div>
            @endif
            @if (!$expired)
                @if ($offre->img_offre)
                    <div class="my-4">
                        <img class="img-fluid" src="{{ asset('storage/' . $offre->img_offre) }}">
                        <div class="d-flex justify-content-around mt-3">
                            <a href="#" onclick="share()">
                                <img src="{{ asset('img/icons/share.png') }}" alt="">
                            </a>
                            <a href="#" onclick="PrintImage('{{  asset('storage/' . $offre->img_offre) }}'); return false;">
                                <img src="{{ asset('img/icons/printer.png') }}" alt="">
                            </a>
                            <a href="{{ asset('storage/' . $offre->img_offre) }}" download>
                                <img src="{{ asset('img/icons/download.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <hr>
                @endif
                @if ($offre->img_offre2)
                    <div class="my-4">
                        <img class="img-fluid" src="{{ asset('storage/' . $offre->img_offre2) }}">
                        <div class="d-flex justify-content-around mt-3">
                            <a href="#" onclick="share()">
                                <img src="{{ asset('img/icons/share.png') }}" alt="">
                            </a>
                            <a href="#" onclick="PrintImage('{{  asset('storage/' . $offre->img_offre2) }}'); return false;">
                                <img src="{{ asset('img/icons/printer.png') }}" alt="">
                            </a>
                            <a href="{{ asset('storage/' . $offre->img_offre2) }}" download>
                                <img src="{{ asset('img/icons/download.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <hr>
                @endif
               
            @endif

            @auth
                @if ($journal_ar || $journal_fr)
                    <div class="row mt-4">
                        @if ($journal_ar)
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('storage/journal/' . $journal_ar->logo) }}" alt="">
                            </div>
                        @endif

                        @if ($journal_fr)
                        <div class="col-md-4">
                            <img class="img-fluid" src="{{ asset('storage/journal/' . $journal_fr->logo) }}" alt="">
                        </div>
                        @endif
                    </div>
                    <hr>
                @endif
            @endauth

            @guest
                <hr>
                <div class="my-4 text-center">
                    <a href="{{ route('register') }}" class="btn btn-lg btn-primary">
                        <b>Inscrivez-vous gratuitement</b>
                        <br>
                        avec <span class="">3</span> jours d’essai
                    </a>
                </div>
                <hr>
            @endguest
           
            <div class="my-4">
                La date de remise des offres est donnée à titre indicatif, veuillez confirmer la date réelle auprès de l’annonceur
            </div>
        </div>
    </div>		
</div>

{{-- share modal --}}
<div class="modal fade" id="share" tabindex="-1" role="dialog" aria-labelledby="shareTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="shareTitle">Partager</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-around">
            <!-- Sharingbutton Facebook -->
            <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u={{ urlencode(route('detail', $offre)) }}" target="_blank" rel="noopener" aria-label="">
                <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                </div>
                </div>
            </a>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>  

<script>

    function share() {
        if(navigator.share){
            navigator.share({
                title: '{{ $offre->titre }}',
                url: '{{ route('detail', $offre) }}'
            }).then(() => {
                $('#share').modal('hide');
            });
        }else{
            $('#share').modal('show');
        }
    }

    function ImagetoPrint(source)
    {
        return "<html><head><scri"+"pt>function step1(){\n" +
                "setTimeout('step2()', 10);}\n" +
                "function step2(){window.print();window.close()}\n" +
                "</scri" + "pt></head><body onload='step1()'>\n" +
                "<img src='" + source + "' /></body></html>";
    }

    function PrintImage(source)
    {
        var Pagelink = "about:blank";
        var pwa = window.open(Pagelink, "_new");
        pwa.document.open();
        pwa.document.write(ImagetoPrint(source));
        pwa.document.close();
    }

</script>

@endsection