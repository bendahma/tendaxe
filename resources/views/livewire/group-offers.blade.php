<div>
    @foreach($pendingOffers as $index => $offer)
        @livewire('single-offer', ['offer' => $offer], key($offer->id))
    @endforeach
</div>
