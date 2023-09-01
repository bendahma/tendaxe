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
    public $wilaya = 'Alger';
    public $etablissement;
    public $secteur = [];
    public $journalOffre ;
    public $journal;
    public $journalF;
    public $journalA;
    public $status = "Appel d'offres & Consultation";
    public $description;
    public $date_publication;
    public $date_after = 15 ;
    public $date_echeance;
    public $image ;
    public $showList = false; // New property to control the visibility of the list

    

    
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
    }

    public function chooseSelectedItem()
    {
        if ($this->selectedItem) {
            $this->titre = $this->selectedItem->titre;
            $this->resetSelectedItem();
            $this->showList = false;
        }

        // $this->updatedTitre() ;
        
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
        $this->showList = false; 
    }

    public function hideChoices()
    {
        $this->showList = false;
    }

    public function updatedTitre(){
        $this->reset('secteur');
        $lastYear = Date('Y') - 1 ;
        $from = Date($lastYear.'-m-d');
        $to = Date('Y-m-d');
        $this->titreResults = Offre::where('titre', 'like', '%' . $this->titre . '%')->whereBetween('created_at', [$from, $to])
                                                                                    ->latest('created_at')
                                                                                    ->limit(100)
                                                                                    ->with('secteur:id')
                                                                                    ->get(['id','titre']);
        $this->titreCount = $this->titreResults->count();

        $this->showList = true; 

        if(!empty($this->titreResults) && !empty($this->titre)){
            foreach ($this->titreResults as $offre) {
                foreach ($offre->secteur as $secteur) {
                    if (!in_array($secteur->id, $this->secteur)) {
                        $this->secteur[] = $secteur->id;
                    }
                }
            }

        } else {
            $this->reset('secteur') ;
        }
    }

    public function updatedSecteur(){
        $this->updatedTitre();
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
        $this->validate([
            'journalOffre' => 'required'
        ]);

        
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
