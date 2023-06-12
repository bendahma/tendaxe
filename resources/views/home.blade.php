@extends('layouts.layout')

@section('title', 'Acceuil')

@section('content')
	<header class="d-flex flex-column justify-content-around">
			<div class="container mx-auto row mt-5 pt-5">
				<div class="col-md-6">
					<div class="text-white">
						<div id="wlc" class="h3 font-weight-600 mb-md-4 text-24">Bienvenue sur TendAxe</div>
						<div class="h5 text-18">
						    TendAxe est votre plateforme professionnelle pour les appels d'offres et les consultations sur le marché public et privé.
						</div>
					</div>
				</div>
			</div>
			<div class="container text-right">
				<a class="btn btn-primary btn-lg mr-4 font-weight-600" href="{{ route('search') }}">Voir appels d'offres  <img class="pl-4" src="{{ asset('img/icons/arrow.png') }}"></a>
			</div>
			<div class="container mx-auto text-white text-center hide-md">
				<h3 class="font-weight-600 text-26">Pourquoi TendAxe?</h3>
				<p class="font-weight-500 text-15">Avec un abonnement à notre site internet, vous pouvez consulter tous les appels d'offres et les consultations dans votre domaine d'activité, ainsi que toutes les informations relatives à l'appel d'offre, ses résultats, ses delais, et également obtenir les copies certifiées conformes qui seront publiées dans les sources officielles (la presse nationale, BOMOT, BOASEM...).</p>
				<p class="font-weight-500 text-15">TendAxe arrive en exclusivité pour vous offrir la possibilité de publier vos appels d'offres, demandes d'achat, projets de sous-traitance ( petits marchés ) auprès d'entreprises ou de particuliers. Nous mettons également à votre disposition un service juridique ainsi qu'une assistance pour vos projets</p>
			</div>
			<div class="container mx-auto text-white text-center show-md">
				<h3 class="font-weight-600 text-26">Pourquoi TendAxe?</h3>
				<p class="font-weight-500 text-15">Avec un abonnement à notre site internet, vous pouvez consulter tous les appels d'offres et les consultations dans votre domaine d'activité, ainsi que toutes les informations relatives à l'appel d'offre, ses résultats, ses delais, et également obtenir les copies certifiées conformes qui seront publiées dans les sources officielles (la presse nationale, BOMOT, BOASEM...).</p>
				<p class="font-weight-500 text-15">TendAxe arrive en exclusivité pour vous offrir la possibilité de publier vos appels d'offres, demandes d'achat, projets de sous-traitance ( petits marchés ) auprès d'entreprises ou de particuliers. Nous mettons également à votre disposition un service juridique ainsi qu'une assistance pour vos projets</p>
			</div>
	</header>

		<section class="container my-5">
			<div class="row mx-0">
				<div class="col-md-4 px-md-0">
					<div class="mb-3">
						<div class="d-flex align-items-center">
							<img src="{{ asset('img/icons/annouce2.png') }}" width="40px" height="40px">
							<span class="ml-3 font-weight-700">Soyez informe</span>

						</div>
						<div class="mt-2">
							<small class="font-weight-500">
								Nous publions chaque jour tout les appels d'offres, consultation et ses résultats (attribution annulation, Mise à jour ... ) disponible dans le marché algérien
							</small>
						</div>
					</div>
					<div class="mb-3">
						<div class="d-flex align-items-center">
							<img src="{{ asset('img/icons/search3.png') }}" width="40px" height="40px">
							<span class="ml-3 font-weight-700">Découvrez de nouveaux fournisseurs</span>
						</div>
						<div class="mt-2">
							<small class="font-weight-500">
								Publiez vos demandes achats, appels d'offres et sous-traitance sur notre plateforme et recevez des offres de fournisseurs qualifiés
							</small>
						</div>
					</div>
					<div class="mb-3">
						<div class="d-flex align-items-center">
							<img src="{{ asset('img/icons/two_hands.png') }}" width="40px" height="40px">
							<span class="ml-3 font-weight-700">trouvez des sous-traitances</span>
						</div>
						<div class="mt-2">
							<small class="font-weight-500">
								Consulter toutes les offres d'avantages proposées par des entreprise ou des ordinaires et Trouver des projet deuxième main en tant que sous-traitance
							</small>
						</div>
					</div>
				</div>
				<div class="col-md-4 d-flex align-items-center justify-content-center my-2">
					<img class="img-fluid" src="{{ asset('img/figure1.png') }}">
				</div>
				<div class="col-md-4 px-md-0">
					<div class="mb-3">
						<div class="d-flex align-items-center">
							<img src="{{ asset('img/icons/email.png') }}" width="40px" height="40px">
							<span class="ml-3 font-weight-700">Service d’Alerte E-mail</span>
						</div>
						<div class="mt-2">
							<small class="font-weight-500">
								Vous recevrez deux bulletins d’alerte: <br>
								un à Midi pour assurer la rapidité de l’information, et deuxième en fin de journee pour vous résumer l’intégralité des annonces publiées.
							</small>
						</div>
					</div>
					<div class="mb-3">
						<div class="d-flex align-items-center">
							<img src="{{ asset('img/icons/notifbell.png') }}" width="40px" height="40px">
							<span class="ml-3 font-weight-700">Service de notification</span>
						</div>
						<div class="mt-2">
							<small class="font-weight-500">
								Favorisez vos appels d’offre ainsi que les organismes désirés et vous serez notifiés de leurs résultats dans le but de suivre leurs évolutions par étapes et leur publication respectivement.
							</small>
						</div>
					</div>
					<div class="mb-3">
						<div class="d-flex align-items-center">
							<img src="{{ asset('img/icons/doc_search.png') }}" width="40px" height="40px">
							<span class="ml-3 font-weight-700">Systeme de recherches Avancé</span>
						</div>
						<div class="mt-2">
							<small class="font-weight-500">
								TendAxe met entre vos mains un moteur recherche avancé, qui offre une multitudes de critères pour vous simplifier la recherche de marchés publics.
							</small>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="howto" class="my-5">
			<h3 class="text-center font-weight-600">Comment s'inscrire</h3>
			<div class="container row mt-4 mx-auto">
				<div class="col-md-8">
					<div class="d-flex">
						<span class="bold mr-4 h4">1</span>
						<p class="font-weight-500">
							Inscrivez gratuitement en tant que nouveau <span class="">utilisateur remplissant le formulaire d'inscription (nom, prénom, e-mail, numéro de téléphone et certains champs) et bénéficiez de 3 jours d'éssai gratuit.</span>
						</p>
					</div>
					<div class="d-flex">
						<span class="bold mr-4 h4">2</span>
						<p class="font-weight-500">
							Connectez-vous avec votre e-mail et votre mot de passe.
						</p>
					</div>
					<div class="d-flex">
						<span class="bold mr-4 h4">3</span>
						<p class="font-weight-500">
							choisissez le pack qui vous conviendrez (bronz, silver, gold, platine, Ultra).
						</p>
					</div>
					<div class="d-flex">
						<span class="bold mr-4 h4">4</span>
						<p class=" font-weight-500">
							votre compte professionnel annuel sera activé dés la réception de votre reçu de payement
						</p>
					</div>
				</div>
				<div class="col-md-4 text-center d-flex align-items-center justify-content-center">
					<a href="{{ route('register') }}" class="btn btn-lg btn-primary">
						<b>Inscrivez-vous gratuitement</b>
						<br>
						avec <span class="">3</span> jours d’essai
					</a>
				</div>
			</div>
		</section>

		<section id="latest" class="container my-5">
			<h3 class="text-center  mb-4 font-weight-600">Derniers annonces</h3>
			@foreach (App\Models\Offre::where('etat', 'active')->latest()->take(4)->get() as $item)
			<x-offre :exp="false" :offre="$item" />
			{{-- <div class="my-2">
				<div class="bg-white px-3 pt-3 border rounded">
					<div class="row mb-3">
						<div class="col-9 col-md-10 pr-0 bold">
							<div>
								{{ $item->titre }}
							</div>
						</div>
						<div class="col-3 col-md-2 pl-md-0 text-right">
							<img class="" src="{{ asset('img/icons/lock2.png') }}" width="64px">
						</div>
					</div>
						<div class="mb-2">
							<span class="bold">Annonceur: </span>
							<img src="{{ asset('img/icons/lock.png') }}">
							Réservé aux abonnés
						</div>
						<div class="mb-2">
							<span class="bold">Statut: </span>
							{{ $item->statut }}
						</div>
						<div class="mb-2">
							<span class="bold">Wilaya: </span>
							<img src="{{ asset('img/icons/lock.png') }}">
							Réservé aux abonnés
						</div>
						<div class="my-3 d-flex">
							<span class="mx-auto mt-2"> <img src="{{ asset('img/icons/play.png') }}"> {{ $item->date_pub }}</span>
							<span class="mx-auto mt-2"> <img src="{{ asset('img/icons/stop.png') }}"> {{ $item->date_limit }}</span>
							<a href="{{ route('detail', $item) }}" class="btn btn-sm btn-primary ml-auto">Detail</a>
						</div>
				</div>
			</div> --}}
			@endforeach
			
			<div class="text-right">
				<a href="{{ route('search') }}" class="btn btn-primary font-weight-600">Tous les appels d’offre <img class="pl-4" src="{{ asset('img/icons/arrow.png') }}"></a>
			</div>
		</section>

		<section id="servies" class="container my-5">
			<div class="row">
				<div class="col-md-4 text-center px-4 my-2 ">
					<div class="bg-white p-3 border h-100">
						<img class="img-fluid mx-auto my-3" src="{{ asset('img/icons/doc.png') }}">
						<div class="h4 bold">+<span class="counter">1900</span></div>
						<small class="bold">Publications / Semaine</small>
					</div>
				</div>
				<div class="col-md-4 text-center px-4 my-2">
					<div class="bg-white p-3 border h-100">
						<img class="img-fluid mx-auto my-3" src="{{ asset('img/icons/building.png') }}">
						<div class="h4 bold">+<span class="counter">10000</span></div>
						<small class="bold">
							Entreprises sur l’annuaire
							(disponible bientôt)
						</small>
					</div>
				</div>
				<div class="col-md-4 text-center px-4 my-2 ">
					<div class="bg-white p-3 border h-100">
						<img class="img-fluid mx-auto my-3" src="{{ asset('img/icons/annouce.png') }}">
						<div class="h4 bold">+<span class="counter">170</span></div>
						<small class="bold">sources d’annonces</small>
					</div>
				</div>
			</div>
		</section>

		<section id="offers" class="container my-5">
			<h3 class="font-weight-600 text-center mb-3">Nos forfaits</h3>
			<ul class="font-weight-500">
				<li>
					Consulter tous les types d'annonces proposées (appels d'offres, consultations, annonces de subventions temporaires, annonces d'annulation, notifications, annonces de prolongation et de retard des délais, annonce d'offres ...)
				</li>
				<li>
					Alerter toutes les offres proposées dans votre secteur privé par e-mail pendant une semaine
				</li>
				<li>
					Ajoutez vos offres gratuitement pour une durée illimitée
				</li>
				<li>
					Consulter les offres les sous-traitences proposés par des entreprises ou les ordinairers.
				</li>
			</ul>
			<div class="row my-4">
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up">
					<div class="bg-white mx-auto pb-2 rounded h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-light-gray mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">Forfait gratuit à vie</div>
						<div class="h1 text-center text-green my-4">0 DA</div>
						<div class="my-2">
							<ul class="">
								<li>Découvrez le site pendant une période illimitée sans passer en revue tous les détails</li>
								<li class="">publiez vos offres et vos appels d'achat d'une façon illimité</li>
							</ul>
						</div>
						{{-- <div class="text-center mt-auto px-2">
							<a href="{{ route('register') }}" class="btn btn-primary bold w-100">Demander</a>
						</div> --}}
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up" data-aos-duration="700">
					<div class="bg-white mx-auto pb-2 rounded h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-orange mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">Pack de bronze</div>
						<div class="h1 text-center text-green my-4">
							<span>11000</span> DA/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Choisissez 1 secteur</li>
								<li>Un utilisateur</li>
								<li>Toutes les fonctionnalités énumérées ci-dessus</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							@auth
								<button class="btn btn-primary bold w-100" data-abonnement="bronze" data-toggle="modal" data-target="#exampleModal">Demander</button>
							@endauth
							@guest
								<a href="{{ route('register') }}" class="btn btn-primary bold w-100">Demander</a>
							@endguest
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up" data-aos-duration="900">
					<div class="bg-white mx-auto pb-2 rounded h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-light-gray mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">pack Silver</div>
						<div class="h1 text-center text-green my-4">
							<span>17000</span> DA/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Choisissez 3 secteurs</li>
								<li>Deux utilisateurs</li>
								<li>Toutes les fonctionnalités énumérées ci-dessus</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							@guest
								<a href="{{ route('register') }}" class="btn btn-primary bold w-100">Demander</a>
							@endguest
							@auth
								<button class="btn btn-primary bold w-100" data-abonnement="silver" data-toggle="modal" data-target="#exampleModal">Demander</button>
							@endauth
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up">
					<div class="bg-white mx-auto pb-2 rounded h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-yellow mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">Pack gold</div>
						<div class="h1 text-center text-green my-4">
							<span>24000</span> DA/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Choisissez 6 secteurs </li>
								<li>Trois utilisateurs</li>
								<li>Toutes les fonctionnalités énumérées ci-dessus</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							@guest
								<a href="{{ route('register') }}" class="btn btn-primary bold w-100">Demander</a>
							@endguest
							@auth
								<button class="btn btn-primary bold w-100" data-abonnement="gold" data-toggle="modal" data-target="#exampleModal">Demander</button>
							@endauth
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up" data-aos-duration="700">
					<div class="bg-white mx-auto pb-2 rounded h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-red mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">pack platine</div>
						<div class="h1 text-center text-green my-4">
							<span>28000</span> DA/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Choisissez 10 secteurs</li>
								<li>Trois utilisateurs</li>
								<li>Toutes les fonctionnalités énumérées ci-dessus</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							@guest
								<a href="{{ route('register') }}" class="btn btn-primary bold w-100">Demander</a>
							@endguest
							@auth
								<button class="btn btn-primary bold w-100" data-abonnement="platine" data-toggle="modal" data-target="#exampleModal">Demander</button>
							@endauth
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up" data-aos-duration="900">
					<div class="bg-white mx-auto pb-2 rounded h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-blue mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">pack ultra</div>
						<div class="h1 text-center text-green my-4">
							<span>34000</span> DA/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Touts les secteurs</li>
								<li>Quatre utilisateurs</li>
								<li>Toutes les fonctionnalités énumérées ci-dessus</li>
								<li>Assistance juridique</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							@guest
								<a href="{{ route('register') }}" class="btn btn-primary bold w-100">Demander</a>
							@endguest
							@auth
								<button class="btn btn-primary bold w-100" data-abonnement="ultra" data-toggle="modal" data-target="#exampleModal">Demander</button>
							@endauth
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="payement" class="container my-5">
			<h4 class="bold ">Paiement</h4>
			<ul class="font-weight-500">
				<li>
                    Contactez-nous au <b>07 78 33 00 81</b> pour demander votre devis.
                    Payez les frais de l'abonnement choisi par dépôt ou virement sur le compte bancaire suivant :
                    <br>
                    <b>« AGENCE BDL PINS MARITIM-00110 PALAIS DES EXPOSITION MOHAMMADIA 16046 ALGER » :</b>
                    <br>
                    <b>SARL TENDAXE</b>
                    <br>
                    <b>005-001100000005932-81</b>
                    <br>
                    Vous pouvez également payer via Baridimob: <b>00799999002059813054</b>
				</li>
				<li>Veulliez envoyer une copie de la preuve de paiement par Viber à l'un des numéros suivants : <b>07 78 33 00 81</b> ou par e-mail à l'adresse suivante : <b>contact@tendaxe.com</b></li>
				<li>Payez en espèces ou par chèque en vous rendant dans nos bureaux situés à l'adresse suivante : <b>Centre de commerce et des affaires El Djenina, Ilot 10, section 11, Local N 1087, Mohammadia-Alger.</b> </li>
				<li>Votre compte sera activé dès réception de votre reçu de paiement.</li>
			</ul>
		</section>

		<section id="acheteurs" class="container" style="margin-top: 30vh; margin-bottom: 20vh;">
			<h1 class="font-weight-600 text-center text-gray">Nos acheteurs actifs</h1>
			<div class="text-center my-5">
				<img class="img-fluid" src="{{ asset('img/acheteurs/1.png') }}" alt="">
			</div>
			<div class="row justify-content-center my-4 hide-md">
			@for ($i = 2; $i <= 8; $i++)
				<div class="col text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/'.$i.'.png') }}" alt="">
				</div>
			@endfor
			</div>
			<div class="row justify-content-center my-4 hide-md">
				@for ($i = 9; $i <= 15; $i++)
					<div class="col text-center">
						<img class="img-fluid" src="{{ asset('img/acheteurs/'.$i.'.png') }}" alt="">
					</div>
				@endfor
			</div>

			{{-- mobile acheteurs --}}
			<div class="row show-md justify-content-center">
				<div class="col-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/9.png') }}" alt="">
				</div>
				<div class="col-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/14.png') }}" alt="">
				</div>
				
			</div>
			<div class="row show-md">
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/4.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/5.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/6.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/7.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/8.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/2.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/10.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/11.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/3.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/15.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/12.png') }}" alt="">
				</div>
				<div class="col-3 my-3 text-center">
					<img class="img-fluid" src="{{ asset('img/acheteurs/13.png') }}" alt="">
				</div>
				

			</div>
		</section>

		<!-- demander Modal -->
		<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Demander un Pack</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
			  <form action="">
				  <div class="modal-body">
					   <div class="form-group">
						   <select class="form-control selectpicker" onchange="UpdateMaxSect(this)" name="pack" id="pack">
								<option value="bronze">Bronze</option>
								<option value="silver">Silver</option>
								<option value="gold">Gold</option>
								<option value="platine">Platine</option>
								<option value="ultra">Ultra</option>
						   </select>
					   </div>
					   <div class="form-group">
						   <select class="form-control selectpicker" multiple data-title="Secteurs" name="secteurs[]" id="sect">
								@foreach (App\Models\Secteur::All() as $sect)
									<option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}">{{ $sect->secteur }}</option>
								@endforeach
						   </select>
					   </div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					<button type="button" class="btn btn-primary" id="demander" onclick="demander_pack($(this))">Demander</button>
					<button class="btn btn-info" type="button" id="loading" disabled style="display: none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						Demander
					</button>
					  
				  </div>
			  </form>
		    </div>
		  </div>
		</div>

		<!-- success Modal -->
		<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
			<div class="modal-content">
				
				<div class="modal-body" id="resultat_demande">
					<h5 class="bold mb-4">
						voila les détails de l'abonnement choisie:
					</h5>
					<div class="mb-2">
						<b>Le pack: </b>
						<span id="selected_pack"></span>
					</div>
					<div class="bold">Les secteurs:</div>
					<ul class="mb-0" id="selected_secteurs">
						
					</ul>
					<div class="">
						<b>Prix:</b>
						<span id="prix"></span>
					</div>
					<div class="mt-4">
						votre demande va prendre en charge <span class="">par les administrateurs dés la réception de votre reçu de payement ( par viber 0778  33 00 81 , notre e-mail contact@tendaxe.com ou à travers une présence au niveau de notre bureau )</span>
					</div>
					<div class="mt-3 text-right">
						<button type="button" class="btn btn-primary px-4" data-dismiss="modal">OK</button>
					</div>
				</div>
				
			</div>
			</div>
		</div>

		<!-- Error Modal -->
		<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Erreur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
				Votre demande n'a pas été effectuer, veuillez réessayer plus tard.
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-primary px-3" data-dismiss="modal">Ok</button>
				</div>
			</div>
			</div>
		</div>
		<script type="text/javascript">
    		// navbar
			$(".navbar").removeClass("bg-light");
			$(".navbar").removeClass("navbar-light");
			$(".navbar").addClass("navbar-dark");
			$("#logo").addClass("text-white");
			
			$("#custom-toggle-icon").attr("src","{{ asset('img/icons/navbar_button_light.png') }}");

    		$(window).scroll(function (event) {
    			var height = $(window).scrollTop();

    			    if(height <= 0) {
    			        $(".navbar").removeClass("bg-light shadow navbar-light");
    			        $(".navbar").addClass("navbar-dark");

    			        $("#logo").addClass("text-white");

						$("#custom-toggle-icon").attr("src","{{ asset('img/icons/navbar_button_light.png') }}");

    			    }else{
    			    	$(".navbar").addClass("bg-light shadow navbar-light");
    			    	$(".navbar").removeClass("navbar-dark");

    			        $("#logo").removeClass("text-white");

						$("#custom-toggle-icon").attr("src","{{ asset('img/icons/navbar_button_dark.png') }}");

    			    }

    		});

    		$( document ).ready(function () {
    			$('.counter').counterUp({
    			   delay: 10,
    			   time: 1000,
    			 });
    			// init animate on scroll
    			AOS.init();
    		});

			$('#exampleModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var id = button.data('abonnement') 
				$('#pack').selectpicker('val', id).change();
			});

			$('#exampleModal').on('hidden.bs.modal', function (e) {
				$('#demander').show();
				$('#loading').hide();

				$('#sect').prop('disabled', false);
  				$('#sect').selectpicker('refresh');
			});

			function UpdateMaxSect(e) {
				// console.log(e.value);
				$('#sect').selectpicker('deselectAll')

				var max = 1;
				var prix = "";
				switch(e.value){
					case 'bronze': max = 1;
									prix = "11000 DA/an";
						break;
					case 'silver': max = 3;
									prix = "17000 DA/an";
						break;
					case 'gold': max = 6;
									prix = "24000 DA/an";
						break;
					case 'platine': max = 10;
									prix = "28000 DA/an";
						break;
					case 'ultra': max = false;
									prix = "34000 DA/an";
						$('#sect').selectpicker('selectAll');
						break;
				}

				$('#sect').data('max-options', max).selectpicker('refresh');
				$('#prix').text(prix);
			}

			function demander_pack(e) {
				$('#demander').hide();
				$('#loading').show();

				$('#sect').prop('disabled', true);
  				$('#sect').selectpicker('refresh');
				
				$.ajax({
					type: 'post',
					url: "{{ route('user.pack.add') }}",
					data: {
						"_token" : "{{ csrf_token() }}",
						"secteurs": $('#sect').val(),
						"nom_abonnement": $('#pack').val(),
					},
					error: function () {
						// error

						$('#exampleModal').modal('hide');
						$('#errorModal').modal('show');

					},
					success: function(res){
						console.log(res);
						// console.log(data);
						
						if(res){
							// insert data to success model
							$('#selected_pack').text(res.data.abonnement);
							var secteurs = "";
							for(var k in res.data.secteurs){
								secteurs += '<li>'+ res.data.secteurs[k].secteur +'</li>';
							}
							console.log(secteurs);
							$('#selected_secteurs').html(secteurs);
							$('#exampleModal').modal('hide');
							$('#successModal').modal('show');
						}
				}});


			}
    	</script>
@endsection