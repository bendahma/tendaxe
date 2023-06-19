<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Offre;
use App\Models\Journalar;
use App\Models\Journalfr;
use App\Models\TempOffer;
use Illuminate\Support\Facades\Auth;

class SingleOffer extends Component
{
    public $dismiss;
    public $offer_id ;

    public $type_journal;
    public $modalForNewEtab = false ;
    public $saved = false ;
    public $offer ;

    public $titre;
    public $etablissement;
    public $secteur = [];
    public $journalF;
    public $journalA;
    public $status;
    public $wilaya;
    public $description;
    public $date_publication;
    public $date_after = 15 ;
    public $date_echeance;
    public $image ;

    // $this->validate($request, [
    //     'titre' => 'required',
    //     'description' => 'nullable',
    //     'date_pub' => 'required|date',
    //     'date_lim' => 'required|date',
    //     'secteur' => 'required|array',
    //     'statut' => 'required|max:255',
    //     'wilaya_offre' => 'max:255',
    //     'type' => 'in:national,international',
    //     'prix' => 'nullable|numeric',
    //     'etab' => 'required|numeric',
    //     'journal_ar' => 'required|numeric',
    //     'journal_fr' => 'required|numeric',
    //     'photo' => 'required_if:description,value|mimes:jpeg,jpg,png|max:100000', // max 10000kb
    //     'photo2' => 'required_if:description,value|mimes:jpeg,jpg,png|max:100000', // max 10000kb
    // ]);

    
    public function mount($offer)
    {
        $this->offer = $offer;
        $this->image = $this->offer->titre;
        $this->dismiss = false ;
        
    }

    public function updatedEtablissement(){
        if($this->etablissement == 0){
            $this->emit('openModal', $this->offer->id);
        }
    }

    public function updatedDatePublication(){
        $this->updatedDateAfter();
    }

    public function updatedDateAfter(){
        $this->date_echeance = date('Y-m-d', strtotime($this->date_publication . ' +' . $this->date_after .' days'));
    }

    public function submit(){

        $offre = Offre::create([
            'user_id' => Auth::id(),
            'titre' => $this->titre,
            'statut' => $this->status,
            'type' => 'national',
            'wilaya' => $this->wilaya,
            'description' => $this->description,
            'date_pub' => $this->date_publication,
            'date_limit' => $this->date_echeance,
            'img_offre' => $this->image,
            'img_offre2' => NULL,
            'adminetab_id' => $this->etablissement,
            'journalar_id' => $this->journalA,
            'journalfr_id' => $this->journalF,
            'etat' => "active",
            'published' => false,
        ]);

        

        $offre->secteur()->sync($this->secteur);

        $this->dismiss = true ;

        $tempOffer = TempOffer::find($this->offer->id)->delete();

    }

    public function render()
    {
        return view('livewire.single-offer');
    }
}
