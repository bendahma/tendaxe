@extends('layouts.layout')

@section('title', 'Verification email')

@section('content')
    
    <div class="container d-flex flex-column align-items-center mt-8 justify-content-center" style="height: 90vh">
            <form class="text-center" method="POST" action="{{ route('phone.update',$user->id) }}">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <div class="d-none d-md-block" style="font-size: 3rem; font-weight:300">Changé votre numéro de téléphone</div>
                    <div class="d-md-none d-sm-block" style="font-size: 2rem">Confirmez votre numéro de téléphone</div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="phone" placeholder="N° Téléphone ...">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4">Confirmé</button>
            </form>
            @if (isset($error))
            
            <div class="alert alert-danger my-4" role="alert">
                <div class="alert-message">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ $error }}   </p> 
                        <a class="mb-0 pl-2 d-flex align-items-center" href="{{ route('users.relogin',$user->id) }}">
                            <div style="width: 40px">
                                <img class="mr-2 p-1" src="{{ asset('img/icons/login.png') }}" alt="">
                            </div>
                            <span>click ici pour connecté</span>
                        </a>
                        
                    </div>
                </div>
            </div>
           
            
            @endif
            
        
    </div>

@endsection