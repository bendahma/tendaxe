<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\Offre;
use App\Models\Secteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile');

        // // get current user offers
        // $offres = Offre::where('user_id', Auth::id())->latest()->paginate(5);

        // // get etablissement img
        // $etab = Auth::user()->etablissement;

        // $img = null;

        // if($etab && $etab->category === "AUTRE"){
        //     $img = $etab->logo;
        // }

        // return view('user.profile', [
        //     'offres' => $offres,
        //     'logo' => $img,
        // ]);
    }

    public function abonnement()
    {
        $secteurs = null;

        $current = Auth::user()->current_abonnement;

        $progressbar = 0;

        if($current){
            if($current->nom_abonnement === "gratuit"){
                $secteurs = Secteur::All();
            }else{
                $secteurs = $current->secteur;
            }

            $progressbar =(int) ((time() - strtotime($current->date_debut)) / (strtotime($current->date_fin) - strtotime($current->date_debut)) * 100);
        }

        

        return view('user.abonnement', [
            'current' => $current,
            'list' => Auth::user()->abonnement,
            'secteurs' => $secteurs,
            'progress' => $progressbar,
        ]);
    }

    public function notif()
    {
        if(!Auth::user()->notif){
            // notif doesnt exist yet so create it
            $notif = Notif::create([
                'user_id' => Auth::id(),
            ]);
        }else{
            $notif = Auth::user()->notif;
        }

        return view('user.notif',[
            'notif' => $notif,
        ]);
    }
}
