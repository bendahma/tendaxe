<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('adminFiles/img/icons/icon-48x48.png') }}" />

	<title>@yield('title')</title>
    
	{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

	<link href="{{ asset('adminFiles/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<!-- selectpicker bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

	 <!-- custom css -->
	 <link rel="stylesheet" href="{{ asset('adminFiles/css/custom.css') }}">

	 <!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

	{{-- dzayer js --}}
	<script src="{{ asset('vendor/dzayer/dzayer.js') }}"></script>

	<!-- selectpicker bootstrap js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ (Auth::user()->type_user !== 'content') ? route('dashboard') : route('rep.dashboard') }}">
                    <span class="align-middle">TendAxe</span>
                </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Offers
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ (Auth::user()->type_user !== 'content') ? route('admin.offers') : route('rep.offers') }}">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">List Offers</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ (Auth::user()->type_user !== 'content') ? route('admin.offers.add') : route('rep.offers.add') }}">
                            <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Add an offers</span>
                        </a>
					</li>
					
					
					
					
					
					<!------------ Modification -------->
					
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{  route('admin.offers.addoffergroupform')  }}">
                            <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Add an offer group</span>
                        </a>
					</li>
					
                    <!------------------------------------>
                    
                    
                    
                    
                    
                    

					@if (Auth::user()->type_user === "admin")

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.trash') }}">
                            <i class="align-middle" data-feather="trash-2"></i> <span class="align-middle">trashed offers</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.pending') }}">
                            <i class="align-middle" data-feather="loader"></i> <span class="align-middle">pending offers</span>
                        </a>
					</li>

					<li class="sidebar-header">
						Users
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.users') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">List users</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.user.add') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Add Content creator</span>
                        </a>
					</li>

					<li class="sidebar-header">
						Admin
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.admins') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">List Admins</span>
                        </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.admins.add') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Add an admin</span>
                        </a>
					</li>
					
					@endif

					<li class="sidebar-header">
						Settings
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ (Auth::user()->type_user !== 'content') ? route('admin.settings') : route('rep.settings') }}">
                            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Change Password</span>
                        </a>
					</li>
					
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-info">logout</button>
                        </form>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
                    @yield('content')
					<div class="test"></div>
				</div>
			</main>

			<footer class="footer">
                <div class="h4 text-center text-muted">TendAxe</div>
            </footer>
		</div>
	</div>
	@yield('script')
	<script src="{{ asset('adminFiles/js/app.js') }}"></script>
	<script>
		$('input[type="date"]').flatpickr({
			'locale': 'fr'
		});
	</script>
</body>

</html>