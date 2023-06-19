<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TempOffer;
use Livewire\WithPagination;

class GroupOffers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
   
    public function render()
    {
        $pendingOffers = TempOffer::paginate(10);
        return view('livewire.group-offers',[
            'pendingOffers' => $pendingOffers,
        ]);
    }

}
