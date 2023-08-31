@extends('layouts.layout')

@section('title', 'Verification email')

@section('content')
    <div class="container d-flex flex-column align-items-center mt-8 justify-content-center" style="height: 90vh">

        @if(isset($successPhoneUpdate))
            {{ @successPhoneUpdate }}
        @endif

        {{-- @if($notificationSend == false) --}}
            <form class="text-center" method="POST" action="{{ route('phone.check') }}">
                @csrf
                <div class="mb-4">
                    <div class="display-4 d-none d-md-block">Confirmez votre numéro de téléphone</div>
                    <div class="d-md-none d-sm-block" style="font-size: 2rem">Confirmez votre numéro de téléphone</div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="code" placeholder="Code de 5 chiffre ...">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4">Confirmé</button>
            </form>
            {{-- <div class="row container my-4 ">
                <div class="col-lg-1 col-md-12 col-sm-12"></div>
                <div class="col-lg-10 col-sm-12">
                    
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            @if($attempt < 3000)
                                <p class="mb-0 mx-5">Vous n'avez pas reçu le code </p>
                                <a href="{{ route('phone.verification') }}" id="resendLink" class="btn btn-sm btn-link" >
                                    Renvoyer le code <span id="countdown" class=""> dans 20</span> 
                                </a>
                                <a href="{{ route('phone.edit',$user->id) }}" id="resendLink" class="btn btn-sm btn-outline-warning btn-link ml-4" >
                                    Modifier numéro Téléphone
                                </a>
                            @else
                            <div class="">
                                <a href="{{ route('phone.edit',$user->id) }}" id="resendLink" class="btn btn-sm btn-link d-flex justify-content-center align-items-center mb-3" >
                                    Modifier numéro Téléphone
                                </a>
                                
                                <p class="d-flex mb-0 justify-content-center align-items-center">
                                    <svg  width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="phone"><path d="M27.308,20.649l-2.2-2.2a3.521,3.521,0,0,0-4.938-.021,2.152,2.152,0,0,1-2.729.267A15.026,15.026,0,0,1,13.3,14.562a2.181,2.181,0,0,1,.284-2.739A3.521,3.521,0,0,0,13.553,6.9l-2.2-2.2a3.514,3.514,0,0,0-4.961,0l-.633.634c-3.3,3.3-3.053,10.238,3.813,17.1,4.14,4.141,8.307,5.875,11.686,5.875a7.5,7.5,0,0,0,5.418-2.061l.634-.634A3.513,3.513,0,0,0,27.308,20.649ZM25.894,24.2l-.634.634c-2.6,2.6-8.339,2.125-14.276-3.813S4.571,9.34,7.171,6.74L7.8,6.107a1.511,1.511,0,0,1,2.133,0l2.2,2.2a1.511,1.511,0,0,1,.021,2.11,4.181,4.181,0,0,0-.531,5.239,17.01,17.01,0,0,0,4.713,4.706,4.179,4.179,0,0,0,5.231-.517,1.512,1.512,0,0,1,2.118.013l2.2,2.2A1.51,1.51,0,0,1,25.894,24.2Z"></path></svg>
                                    veuillez applez <span style="font-weight: bold" class="mx-2">07.78.33.00.81</span>  pour confirmer votre numéro de téléphone. </p>
                                
                            </div>
                            @endif
                           
                        </div>
                    
                </div>
                <div class="col-lg-1 col-sm-12"></div>
            </div> --}}

            <div class="container my-4">
                <div class="row">
                    <div class="col-lg-1 col-md-12 col-sm-12"></div>
                    <div class="col-lg-10 col-sm-12">
                        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center">
                            @if($attempt < 3)
                                <p class="mb-2 mb-sm-0">Vous n'avez pas reçu le code</p>
                                <a href="{{ route('phone.verification') }}" id="resendLink" class="btn btn-sm btn-link mb-2 mx-4 mb-sm-0">
                                    Renvoyer le code <span id="countdown" class=""> dans 45</span>
                                </a>
                                {{-- <br class="d-sm-none"> <!-- Line break for mobile --> --}}
                                <a href="{{ route('phone.edit',$user->id) }}" id="resendLink" class="btn btn-sm text-danger btn-link">
                                    Modifier numéro Téléphone
                                </a>
                            @else
                                <div class="d-flex flex-column">

                                    <a href="{{ route('phone.edit',$user->id) }}" id="resendLink" class="d-flex  justify-content-center align-items-center btn btn-sm text-danger btn-link">
                                        Modifier numéro Téléphone
                                    </a>
                                    
                                    <p class="d-flex  justify-content-center align-items-center text-center my-2">
                                        <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="phone">
                                            <!-- SVG path data -->
                                        </svg>
                                        Veuillez appeler 07.78.33.00.81 pour confirmer votre numéro de téléphone.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-12"></div>
                </div>
            </div>
            
            
        {{-- @else
            <p class="mb-0 h5 font-weight-semibold text-gray-800 text-center" style="line-height: 2;">{{ $success }}</p>
        @endif --}}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const countdownElement = document.getElementById("countdown");
            const linkElement = document.getElementById("resendLink");

            let countdown = 45; // 45 seconds

            function updateCountdown() {
                countdownElement.textContent = 'dans ' + countdown;
                if (countdown === 0) {
                    linkElement.style.pointerEvents = "visible"; // Show the link
                    countdownElement.style.display = "none"; // Show the link
                } else {
                    linkElement.style.pointerEvents = "none";
                    countdown--;
                    setTimeout(updateCountdown, 1000);
                }
            }

            updateCountdown();
        });
    </script>

    <style>
        .display-5 {
            font-size: 16px; /* Adjust as needed */
            font-weight: 300; /* Adjust as needed */
        }       
    </style>

@endsection