@extends('layouts.layout')

@section('title', 'profile')
    
@section('content')
    <div class="container-fluid p-5" style="background: url({{ asset('img/banner/laptop_typing.jpg') }}) no-repeat center center; margin-top: 66px; background-size: cover;">
        <div class="container">
            <h2 class="text-white bold my-4"> Mon Profile </h2>
        </div>
    </div>
    <div class="container mt-0 mt-md-5">
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

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <div class="row">
            <div class="col-md-3 my-3 mt-md-0">
                <a class="d-flex align-items-center text-dark" href="{{ route('profile') }}" style="text-decoration: none;">
                    <img width="25px" class="img-fluid mr-2" src="{{ asset('img/icons/user3.png') }}" alt="">
                    <span class="m-2 ml-3 @yield('link_profile') h5">Mon Profile</span>
                </a>
                <a class="d-flex align-items-center text-dark" href="{{ route('abonnement') }}" style="text-decoration: none;">
                    <img width="25px" class="img-fluid mr-2" src="{{ asset('img/icons/doc2.png') }}" alt="">
                    <span class="m-2 ml-3 @yield('link_abonnement') h5">Mes Abonnements</span>
                </a>
                <a class="d-flex align-items-center text-dark" href="{{ route('notification') }}" style="text-decoration: none;">
                    <img width="25px" class="img-fluid mr-2" src="{{ asset('img/icons/notifbell.png') }}" alt="">
                    <span class="m-2 ml-3 @yield('link_notif') h5">Notification</span>
                </a>
                <a class="d-flex align-items-center text-dark" href="{{ route('user.offers') }}" style="text-decoration: none;">
                    <img width="25px" class="img-fluid mr-2" src="{{ asset('img/icons/annouce.png') }}" alt="">
                    <span class="m-2 ml-3 @yield('link_my_offers') h5">Mes Offres</span>
                </a>
            </div>
            <div class="col-md-9 bg-white border px-2 py-3 mb-3">
                @yield('profile')
            </div>
        </div>
    </div>
@endsection