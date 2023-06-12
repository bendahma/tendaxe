<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <a href="{{ route('home') }}">
        <img src="{{ asset('img/logo2.png') }}" alt="" width="120px">
    </a>
    @foreach ($offres as $item)
        <hr>
        <div>
            <h3>{{ $item->titre }}</h3>
            @if ($expired)
                <h4>Wilaya: Reservé aux abonnés</h4>
            @else
                <h4>Wilaya: {{ $item->wilaya }}</h4>
            @endif
            <h4>Statut: {{ $item->statut }}</h4>
            <h4>Date pub: {{ $item->date_pub }}</h4>
            <div style="text-align: right">
                <a href="{{ route('detail', $item) }}">Voir sur tendaxe</a>
            </div>
        </div>     
    @endforeach
</body>
</html>