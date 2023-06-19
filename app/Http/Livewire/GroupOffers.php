<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GroupOffers extends Component
{

    public $pendingOffers ;

    public function mount($pendingOffers)
    {
        $this->pendingOffers = $pendingOffers;
        // $this->pendingOffers = collect($pendingOffers)->unique('id')->values()->all();

    }

    public function render()
    {
        return view('livewire.group-offers');
    }

    

}
