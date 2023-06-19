<!doctype html>
<html lang="fr">
  	<head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Primary Meta Tags -->
		<meta name="title" content="TendAxe  Appels d'offres et  consultations en Algérie">
		<meta name="description" content="TendAxe est une plateforme professionnelle des appels d'offres et des consultations sur le marché publique et privé pour des projets dans tous les secteurs (domaine) d'activité; en supplément d'information l'ensemble des adjudications et les ventes aux enchères sur le territoire national   الموقع الأكثر احترافية في الجزائر المختص في المناقصات و الاستشارات الخاصة و العمومية لمختلف المشاريع في جميع المجالات الاقتصادية  كما يوفر لكم الموقع كل العروض البيع في المزاد">

		<!-- Open Graph / Facebook -->
		<meta property="og:type" content="website">
		<meta property="og:url" content="https://www.tendaxe.com/">
		<meta property="og:title" content="TendAxe  Appels d'offres et  consultations en Algérie">
		<meta property="og:description" content="TendAxe est une plateforme professionnelle des appels d'offres et des consultations sur le marché publique et privé pour des projets dans tous les secteurs (domaine) d'activité; en supplément d'information l'ensemble des adjudications et les ventes aux enchères sur le territoire national   الموقع الأكثر احترافية في الجزائر المختص في المناقصات و الاستشارات الخاصة و العمومية لمختلف المشاريع في جميع المجالات الاقتصادية  كما يوفر لكم الموقع كل العروض البيع في المزاد">
		<meta property="og:image" content="{{ asset('img/meta.jpg') }}">

		<!-- Twitter -->
		<meta property="twitter:card" content="summary_large_image">
		<meta property="twitter:url" content="https://www.tendaxe.com/">
		<meta property="twitter:title" content="TendAxe  Appels d'offres et  consultations en Algérie">
		<meta property="twitter:description" content="TendAxe est une plateforme professionnelle des appels d'offres et des consultations sur le marché publique et privé pour des projets dans tous les secteurs (domaine) d'activité; en supplément d'information l'ensemble des adjudications et les ventes aux enchères sur le territoire national   الموقع الأكثر احترافية في الجزائر المختص في المناقصات و الاستشارات الخاصة و العمومية لمختلف المشاريع في جميع المجالات الاقتصادية  كما يوفر لكم الموقع كل العروض البيع في المزاد">
		<meta property="twitter:image" content="{{ asset('img/meta.jpg') }}">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}">

		<!-- selectpicker bootstrap CSS -->
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
		
	    <!-- animate on scroll css-->
	    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	    <!-- custom css -->
	    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	    

	    <!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

	    <!-- counting animation -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
	    <script src="{{ asset('vendor/counterup/jquery.counterup.min.js') }}"></script>


	    <!-- animate on scroll js -->
	    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

		{{-- dzayer js --}}
		<script src="{{ asset('vendor/dzayer/dzayer.js') }}"></script>

		<!-- selectpicker bootstrap js -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
		
		{{-- datepicker --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>


	    <title> @yield('title') | TendAxe  Appels d'offres et consultations en Algérie</title>
		<link rel="icon" href="{{ asset('img/icons/main.png') }}" type="image/icon type">
		@livewireStyles
  	</head>
  	<body class="bg-light">	  	
		<nav class="navbar navbar-expand-md navbar-light bg-light px-4 py-md-3 shadow fixed-top">
		  <a class="navbar-brand" href="/">
		  	<div class="h2 my-1">
		  		<b><span id="logo" class="">Tend</span><span class="text-primary">Axe</span></b>
		  	</div>
		  </a>
		  {{-- <button class="navbar-toggler" type="button" data-toggle="slide-collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button> --}}
		<div class="dropdown show-md">
			<a class="show-md" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img id="custom-toggle-icon" src="{{ asset('img/icons/navbar_button_dark.png') }}" alt="">
			</a>
		   
			<div class="dropdown-menu dropdown-menu-right bg-light mx-0" style="max-width: none; margin-top: 29px;" id="custom_nav_drop" aria-labelledby="custom_nav_drop">
				<a class="dropdown-item pl-2 d-flex align-items-center" href="/">
					<div style="width: 40px">
						<img class="mr-2 p-1" src="{{ asset('img/icons/home.png') }}" alt="">
					</div>
					<span>
						Acceuil
					</span>
				</a>
				<a class="dropdown-item pl-2 d-flex align-items-center" href="{{ route('search') }}">
					<div style="width: 40px">
						<img class="img-fluid mr-2 p-1" src="{{ asset('img/icons/annouce2.png') }}" alt="">
					</div>
					<span>
						Appel d’offre
					</span>
				</a>
				<a class="dropdown-item pl-2 d-flex align-items-center" href="{{ route('help') }}">
					<div style="width: 40px">
						<img class="mr-2 p-1" src="{{ asset('img/icons/help2.png') }}" alt="">
					</div>
					<span>Aide</span>
				</a>
				@guest
					<a class="dropdown-item pl-2 d-flex align-items-center" href="{{ route('login') }}">
						<div style="width: 40px">
							<img class="mr-2 p-1" src="{{ asset('img/icons/login.png') }}" alt="">
						</div>
						<span>Connexion</span>
					</a>
					<a class="dropdown-item px-1 d-flex align-items-center" href="{{ route('register') }}">
						<div class="btn btn-primary flex-fill">Inscription</div>
					</a>
				@endguest
				{{-- <a class="dropdown-item" data-toggle="collapse" href="sub_dropdown" data-target="#sub_dropdown" aria-expanded="false" aria-controls="sub_dropdown">Something else here</a> --}}
				{{-- <div class="collapse bordered rounded bg-light" id="sub_dropdown">
					<a class="dropdown-item" href="#">test</a>
					<a class="dropdown-item" href="#">test 2</a>
					<a class="dropdown-item" href="#">test 3</a>
				</div> --}}

				@auth
					<a class="dropdown-item pl-2 d-flex align-items-center" href="{{ route('offre.favorit') }}">
						<div style="width: 40px">
							<img class="mr-2 p-1" width="32px" src="{{ asset('img/icons/star.png') }}" alt="">
						</div>
						<span>Favories</span>
					</a>
					<a class="dropdown-item pl-2" href="#" id="sub_drop" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
						<img src="{{ asset('img/icons/user.png') }}" width="30px" class="">
						<img src="{{ asset('img/icons/dropdown.png') }}" width="25px">
						<span class="">{{ Auth::user()->nom ." ". Auth::user()->prenom  }}</span>
					</a>
					<div class="dropdown mr-4">
						<form action="{{ route('logout') }}" method="POST" class="dropdown-menu dropdown-menu-right bg-light mt-2" aria-labelledby="sub_drop" style="max-width: none;">
							@csrf
							<a class="dropdown-item pl-2 pr-5" href="{{ route('profile') }}">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/user3.png') }}" alt="">
								Profile
							</a>
							<a class="dropdown-item pl-2 pr-5" href="{{ route('abonnement') }}">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/doc2.png') }}" alt="">
								Abonnement
							</a>
							<a class="dropdown-item pl-2 pr-5" href="{{ route('notification') }}">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/notifbell.png') }}" alt="">
								Notification
							</a>
							<a class="dropdown-item pl-2 pr-5" href="{{ route('user.offers') }}">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/stacked_doc.png') }}" alt="">
								Mes Offres
							</a>
							<button type="submit" class="dropdown-item pl-2 pr-5">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/out.png') }}" alt="">
								se deconnecter
							</button>
						</form>
					</div>
				@endauth
			</div>
		</div>
	
		
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-auto align-items-center">
				<li class="nav-item px-2">
				  <a class="nav-link" href="/">Acceuil</a>
				</li>
				<li class="nav-item px-2">
				  <a class="nav-link" href="{{ route('search') }}">Appels d'offre</a>
				</li>
				@if (Auth::check() && Auth::user()->type_user === 'abonné')
					<li class="nav-item px-2">
						<a class="nav-link" href="{{ route('offre.favorit') }}">Favories</a>
					</li>
				@endif	
				<li class="nav-item px-2">
				  <a class="nav-link" href="{{ route('help') }}">Aide</a>
				</li>
				@auth
									
					<li class="nav-item px-2 dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="mr-2">{{ Auth::user()->nom ." ". Auth::user()->prenom  }}</span>
							<img src="{{ asset('img/icons/user.png') }}" class="img-fluid">
							<img src="{{ asset('img/icons/dropdown.png') }}" width="25px">
						</a>
						<form method="POST" action="{{ route('logout') }}" class="dropdown-menu dropdown-menu-right" style="max-width: none;" aria-labelledby="navbarDropdownMenuLink">
							@csrf
							<a class="dropdown-item pl-2 pr-5" href="{{ route('profile') }}">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/user3.png') }}" alt="">
								Profile
							</a>
							<a class="dropdown-item pl-2 pr-5" href="{{ route('abonnement') }}">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/doc2.png') }}" alt="">
								Abonnement
							</a>
							<a class="dropdown-item pl-2 pr-5" href="{{ route('notification') }}">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/notifbell.png') }}" alt="">
								Notification
							</a>
							<a class="dropdown-item pl-2 pr-5" href="{{ route('user.offers') }}">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/stacked_doc.png') }}" alt="">
								Mes Offres
							</a>
							<button type="submit" class="dropdown-item pl-2 pr-5">
								<img class="mr-2" width="25px" src="{{ asset('img/icons/out.png') }}" alt="">
								se deconnecter
							</button>
						</form>

					</li>
				@endauth

				@guest
					<li class="nav-item px-2">
						<a class="nav-link" href="{{ route('login') }}">Connexion</a>
					</li>
					<li class="nav-item px-2">
						<a class="btn btn-primary" href="{{ route('register') }}">Inscription</a>
					</li>
				@endguest
				
		    </ul>
		  </div>
		  
		</nav>

        @yield('content')

        <footer class="footer bg-dark mt-5 px-5 pt-5 pb-2">
			<div class="row">
				<div class="col-md-2">
					<div class="h2 text-md-left text-center">
						<b><span class="text-white">Tend</span><span class="text-primary">Axe</span></b>
					</div>
				</div>
				<div class="col-md-4 tendaxe mt-md-3 mb-2">
					<p class="text-white">
						TendAxe est votre plateforme professionnelle pour les appels d'offres et les consultations sur le marché public et privé.
					</p>
					<div class="text-md-left text-center">
						<a href="{{ route('help') }}">Aide</a>
						<span class="text-primary"> | </span>
						<a href="{{ route('docs') }}">Documents utiles</a>
						<span class="text-primary"> | </span>
						<a href="{{ route('conditions') }}">CGU</a>

						{{-- <a href="{{ route('docs') }}" class="text-primary">Aide | Documents utiles | CGU</a> --}}
					</div>
				</div>
				<div class="offset-md-3 col-md-3 text-md-left text-center">
					<div class="my-3 d-flex">
						<img src="{{ asset('img/icons/cell_phone.png') }}"> <span class="ml-3 text-white">07 78 33 00 81 </span>
					</div>
					<div class="my-3 d-flex">
						<img src="{{ asset('img/icons/phone.png') }}"> <span class="ml-3 text-white">0 25 25 76 82</span>
					</div>
					<div class="my-3 d-flex">
						<img src="{{ asset('img/icons/msg.png') }}" width="22px" height="17px"> <span class="ml-3 text-white"> contact@tendaxe.com </span>
					</div>
					<div class="my-3 d-flex">
						<img src="{{ asset('img/icons/fb.png') }}"> <span class="ml-3 text-white"> tendaxe </span>
					</div>
					<div class="my-3 d-flex">
						<img width="22px" height="27px" src="{{ asset('img/icons/indic.png') }}"> <span class="ml-3 text-white">Centre de commerce et des affaires El Djenina. Ilot 10 section 11 Local N 1087,Mohammadia-alger</span>
					</div>
				</div>
			</div>
			<div class="text-center mt-3 text-white">
				© 2021 www.tendaxe.com - All rights reserved.
			</div>
		</footer>

        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

		@if (Auth::check() && (Auth::user()->type_user === 'admin' || Auth::user()->type_user === 'publisher'))
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
					Voulez vous supprimer cet offre?
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">non</button>
					<form method="POST" action="{{ (Auth::user()->type_user !== 'content') ? route('admin.offre.destroy') : route('rep.offre.destroy') }}">
						@csrf
						@method('DELETE')
						<input type="number" name="offre" id="offre_id" hidden>
						<button class="btn btn-primary">Oui</button>
					</form>
					</div>
				</div>
				</div>
		  	</div>
			@livewireScripts
		  <script type="text/javascript">
	  
			  $('#exampleModalCenter').on('show.bs.modal', function (event) {
				  var button = $(event.relatedTarget) // Button that triggered the modal
				  var id = button.data('id') 
				  
				  $('#offre_id').val(id);
			  });
		  </script>
		@endif
		  <script>
			$(document).on('click', '.show-md .dropdown-menu', function (e) {
				e.stopPropagation();
			});

		  </script>
    </body>