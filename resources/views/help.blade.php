@extends('layouts.layout')

@section('title', 'Aide')
    
@section('content')
    <div class="container-fluid px-md-5 py-5" style="background: url({{ asset('img/banner/laptop_showing.jpg') }}) no-repeat center center; margin-top: 66px; background-size: cover;">
      <div class="">
          <h3 class="text-white bold my-4">Aide</h3>
      </div>
    </div>
    <div class="container main">
      <h5 class="bold mb-4">Pourquoi je choisis TendAxe ?</h5>
      <p class="pl-2">
        La plateforme <span>TendAxe</span> offre à ses clients de nombreux avantages et fonctionnalités qui facilitent la navigation et vous rapproche encore plus des Marchés Publics. En utilisant la plateforme <span>TendAxe</span> vous serez toujours à publication quotidienne des appels d'offre parus dans les journaux dans les 58 Villes (wilayas) : Est Ouest et Nord Algérien, mais aussi les consultations publiées dans les différentes APC en Algérie.
        <br>
        sans oublier les résultats d'appels Attribution, Annulation, d'offre Infructuosité <span>et mise en demeure; et</span> pour vous donner plus d'opportunité de marchés <span>TendAxe</span> assure une publication quotidienne des ventes aux enchères et des avis d'adjudication des 58 <span>wilayas</span> Algériennes.
        <br>
        TendAxe arrive en exclusivité de donner la possibilité de publier votre appels d’offres, demmande d’achat et sous-traitance(projet deuxiem main)et des petits marchés à travers des entreprises ou des ordinaires; un service juridique mis a votre disposition et une assitance pour vos projets.
      </p>

      <h5 class="bold my-4">Nos sources de données</h5>
      <div class="ml-2">
        <p>
          Chaque jour, TendAxe publie l’ensemble des annonces d’achat et vente (Appel d’offres, Consultations, Prorogations de délais, Attributions, Annulations, Informations, Ventes aux enchères, Adjudications) de plusieurs sources :
          <ul class="my-4">
            <li>la presse écrite algérienne (jusqu’à 100 journaux).</li>
            <li>des dizaines de sites d’acheteurs publics <span>et privés.</span></li>
            <li>les revues spécialisés comme le Bulletin Officiel des Marchés de l'Opérateur Public – BOMOP et Bulletin des Appels d'Offres du Secteur de l'Energie et des Mines – BAOSEM.</li>
          </ul>

          Les acheteurs actifs sur TendAxe.com publient également des consultations exclusives directement sur le site.
        </p>

        <div class="d-flex flex-md-row flex-column align-items-center justify-content-around my-5">
          <img class="img-fluid my-2" src="{{ asset('img/logos/boasem.png') }}" alt="">
          <img class="img-fluid my-2" src="{{ asset('img/logos/bomop.png') }}" alt="">
          <img class="img-fluid my-2" src="{{ asset('img/logos/presse.png') }}" alt="">
          <img class="img-fluid my-2" src="{{ asset('img/logos/websites.png') }}" alt="">
        </div>

      </div>

      <h5 class="bold my-4">Comment s'abonner sur TendAxe ?</h5>

      <div class="ml-2">
        <div class="mb-4">
          <h6 class= "bold">Inscription</h6>
          Inscrivez gratuitement en tant que nouveau utilisateur remplissant le formulaire d'inscription (nom, prénom, e-mail, numéro de téléphone et certains champs) et bénéficiez de 3 jours d'éssai gratuit.
        </div>
        
        <div class="mb-4">
          <h6 class="bold">Le choix de la formule</h6>
        
          IL existe 5 formules et chaque une a sa spécification par rapport le nombre de secteur, d’activité et nombre d’utilisateur.
          <br>
          <a class="bold" name="offers" href="/#offers">Clique ici</a> pour voir les différentes  formules 
        </div>

        <div class="mb-4">
          <h6 class= "bold">Payment</h6>
          <ul>
            <li>Payez les frais de l’abonnement choisis Par un dépôt ou virement sur le compte postal:</li>
            <li>nom: <b>HAMMOU</b> prénom: <b>KACEM AMINE - CCP: 0022782357/14</b></li>
            <li>Veuillez envoyer une copie de la preuve de paiement par Viber à l'un des numéros suivants: <b>07 78 33 00 81</b> Ou Via l'e-mail suivant: <b>tendaxe@gmail.com</b></li>
            <li>Payez en espèces ou par chèque en vous rendant dans nos bureaux situés à l'adresse suivante:
              Rue Aouicha Amer</li>
            <li>Votre compte sera activé dés la réception de votre reçu payment.</li>
          </ul>
        </div>

        <div class="mb-5">
          <h6 class="bold">Activation</h6> 
          activation de votre compt avec la possibilité de modifier votre système de notification
        </div>

      </div>

      <x-alert />
      
      <div class="row my-5">
        <div class="col-4 px-1">
          <a href="{{ route('docs') }}" class="btn btn-primary h-100 w-100 d-flex align-items-center justify-content-center">Documents utiles</a>
        </div>
        <div class="col-4 px-1">
          <a href="{{ route('conditions') }}" class="btn btn-primary h-100 w-100 d-flex align-items-center justify-content-center">Conditions générales d'utilisation</a>
        </div>
        <div class="col-4 px-1">
          <a href="/pdf/offre de service.pdf" class="btn btn-primary h-100 w-100 d-flex align-items-center justify-content-center" download>Offre de service</a>
        </div>
      </div>

      <section id="acheteurs" class="" style="margin-top: 30vh; margin-bottom: 20vh;">
        <h1 class="font-weight-600 text-center text-gray">Nos acheteurs actifs</h1>
        <div class="text-center my-5">
          <img class="img-fluid" src="{{ asset('img/acheteurs/1.png') }}" alt="">
        </div>
        <div class="row justify-content-center hide-md my-4">
        @for ($i = 2; $i <= 8; $i++)
          <div class="col text-center">
            <img class="img-fluid" src="{{ asset('img/acheteurs/'.$i.'.png') }}" alt="">
          </div>
        @endfor
        </div>
        <div class="row justify-content-center hide-md my-4">
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
    </div>
@endsection