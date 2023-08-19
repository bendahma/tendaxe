<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .bootstrap-btn {
                display: inline-block;
                font-weight: 400;
                color: #212321;
                text-align: center;
                border: 1px solid transparent;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: .25rem;
                color: #fff;
                background-color: #0de467;
            }


            .bootstrap-btn:hover{
                background-color: #0de467c5;

            }
    </style>
</head>
<body>
    <a href="{{ route('home') }}">
        <img src="{{ asset('img/logo2.png') }}" alt="" width="120px">
    </a>
   <div class="" style="font-size:1rem; font-weight:600">
        New user {{ $user->nom . ' ' . $user->prenom }} is having problems with there phone number verification and asking to verify there phone number {{ $user->phone }}
        <a href="tel:{{$user->phone}}" class="btn btn-success">CALL NOW</a>
    </div>
</body>
</html>