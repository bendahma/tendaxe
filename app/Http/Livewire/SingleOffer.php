<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Offre;
use App\Models\Journalar;
use App\Models\Journalfr;
use App\Models\TempOffer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SingleOffer extends Component
{
    protected $listeners = ['keydown.escape' => 'resetSelectedItem'];

    public $dismiss;
    public $offer_id ;

    public $titreCount = 0 ;
    public $titreResults = [];
    public $selectedItem = null;

    public $type_journal;
    public $modalForNewEtab = false ;
    public $saved = false ;
    public $offer ;

    public $titre;
    public $etablissement;
    public $secteur = [];
    public $journalOffre;
    public $journal;
    public $journalF;
    public $journalA;
    public $status = "Appel d'offres & Consultation";
    public $wilaya;
    public $description;
    public $date_publication;
    public $date_after = 15 ;
    public $date_echeance;
    public $image ;
    public $showList = false; // New property to control the visibility of the list

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
        $this->dismiss = false ;

        $this->offer = $offer;
        
        $this->image = $this->offer->titre;

        $this->date_publication = Carbon::now()->format('Y-m-d');
        
        $d = $this->date_after - 1 ;
        $this->date_echeance = date('Y-m-d', strtotime($this->date_publication . ' +' . $d . ' days'));
        
        $journalFrData = Journalfr::all()->toArray();
        $journalArData = Journalar::all()->toArray();
        $mergedData = array_merge($journalFrData, $journalArData);
        $this->journal = collect($mergedData);

        
    }
    
    public function selectItem($itemId)
    {
        $this->selectedItem = Offre::find($itemId);
        $this->titre = $this->selectedItem->titre;
        $this->showList = false;
        
        $similaireOffers = Offre::where('titre','LIKE','%' . $this->titre . '%')->with('secteur:id')->first(['id','titre']);

        if(!empty($similaireOffers) && !empty($this->titre)){
            $this->secteur = [];
            foreach ($similaireOffers->secteur as $secteur) {
                $this->secteur[] = $secteur->id;
            }
        }else {
            $this->secteur = [];
        }
    }

    public function chooseSelectedItem()
    {
        if ($this->selectedItem) {
            $this->titre = $this->selectedItem->titre;
            $this->resetSelectedItem();
            $this->showList = false;
        }
    }

    public function moveSelection($direction)
    {
        $items = $this->titreResults;

        if ($this->selectedItem === null) {
            $this->selectedItem = $direction === 'up' ? $items->last() : $items->first();
        } else {
            $currentIndex = $items->search(function ($item) {
                return $item->id === $this->selectedItem->id;
            });

            if ($direction === 'up') {
                $previousIndex = $currentIndex - 1;
                $this->selectedItem = $previousIndex >= 0 ? $items[$previousIndex] : $items->last();
            } elseif ($direction === 'down') {
                $nextIndex = $currentIndex + 1;
                $this->selectedItem = $nextIndex < $items->count() ? $items[$nextIndex] : $items->first();
            }
        }
    }

    public function resetSelectedItem()
    {
        $this->selectedItem = null;
        $this->showList = false; // Hide the list after pressing Escape

    }

    public function hideChoices()
    {
        $this->showList = false;
    }

    public function updatedTitre(){
        
        $this->titreResults = Offre::where('titre', 'like', '%' . $this->titre . '%')->get();
        $this->titreCount = Offre::where('titre', 'like', '%' . $this->titre . '%')->count();
        $this->showList = true; 

        $similaireOffers = Offre::where('titre','LIKE','%' . $this->titre . '%')->with('secteur:id')->get(['id','titre']);

        if(!empty($similaireOffers) && $similaireOffers->count() == 1 && !empty($this->titre)){
            $this->secteur = [];
            foreach ($similaireOffers[0]->secteur as $secteur) {
                $this->secteur[] = $secteur->id;
            }
        }else {
            $this->secteur = [];
        }

    }

    public function updatedEtablissement(){
        if($this->etablissement == 0){
            $this->emit('openModal', $this->offer->id);
        }
    }

    public function updatedDatePublication(){
        $this->updatedDateAfter();
    }

    public function updatedJournalOffre(){
        [$id, $source] = explode('_', $this->journalOffre);
        if($source == 'journalAr') {
            $this->journalF = NULL ;
            $this->journalA = $id ;
        }
        if($source == 'journalFr') {
            $this->journalF = $id ;
            $this->journalA = NULL ;
        }
    }

    public function updatedDateAfter(){
        $d = $this->date_after - 1 ;
        $this->date_echeance = date('Y-m-d', strtotime($this->date_publication . ' +' . $d .' days'));
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
        ]);

        $offre->secteur()->sync($this->secteur);

        $tempOffer = TempOffer::find($this->offer->id)->delete();

        $this->dispatchBrowserEvent('offerPublished');

        $this->emit('updateNbrPendingOffers');

        $this->dismiss = true ;
    }

    public function render()
    {
        return view('livewire.single-offer');
    }
}
