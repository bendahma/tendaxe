@extends('layouts.layout')

@section('title', 'Verification email')

@section('content')
    <div class="container d-flex flex-column align-items-center mt-8 justify-content-center" style="height: 90vh">
        @if($notificationSend == false)
            <form class="text-center" method="POST" action="{{ route('phone.check') }}">
                @csrf
                <div class="display-4 mb-4">Confirmez votre numéro de téléphone</div>
                <div class="d-flex justify-content-center">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="code" placeholder="Code de 5 chiffre ...">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4">Confirmé</button>
            </form>
            <div class="row container my-4 ">
                <div class="col-lg-3 col-md-12 col-sm-12"></div>
                <div class="col-lg-6 col-sm-12">
                    
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <p class="mb-0">Vous n'avez pas reçu le code </p>
                            <span id="countdown" class="ml-2">20</span>
                            @if($attempt < 3)
                                <a href="{{ route('phone.verification') }}" id="resendLink" class="btn  btn-sm btn-outline-info" style="display: none;">Renvoyer le code</a>
                            @else
                                <a href="{{ route('phone.sendNotification',$user) }}" id="resendLink" class="btn  btn-sm btn-outline-danger" style="display: none;">Notifié l'admin pour confirmation</a>
                            @endif
                        </div>
                    
                </div>
                <div class="col-lg-3 col-sm-12"></div>
            </div>
        @else
            <p class="mb-0 h5 font-weight-semibold text-gray-800 text-center" style="line-height: 2;">{{ $success }}</p>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const countdownElement = document.getElementById("countdown");
            const linkElement = document.getElementById("resendLink");

            let countdown = 20; // 20 seconds

            function updateCountdown() {
                countdownElement.textContent = countdown;
                if (countdown === 0) {
                    linkElement.style.display = "inline"; // Show the link
                    countdownElement.style.display = "none"; // Show the link
                } else {
                    countdown--;
                    setTimeout(updateCountdown, 1000);
                }
            }

            updateCountdown();
        });
    </script>

@endsection