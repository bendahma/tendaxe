<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TempOffer;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class GroupOffers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['alertMe' => 'setOffAlert'];
   
    public function setOffAlert(){
        Alert::success('Success Title', 'Success Message');
    }

    public function render()
    {
        $pendingOffers = TempOffer::paginate(10);
        return view('livewire.group-offers',[
            'pendingOffers' => $pendingOffers,
        ]);
    }

}
