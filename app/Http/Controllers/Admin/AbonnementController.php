<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbonnementController extends Controller
{
    public function detail($abonnement)
    {
        $abonnement = Abonnement::where('id', $abonnement)->with('secteur:id')->first();
        return $abonnement;
    }
    
    public function store(User $user, Request $request)
    {
        $this->validate($request, [
            'nom_abonnement' => 'required|in:gratuit,bronze,silver,gold,platine,ultra',
            'secteurs' => 'required|array',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'session_limit' => 'required|numeric',
        ]);

        $a = Abonnement::create([
            'user_id' => $user->id,
            'nom_abonnement' => $request->nom_abonnement,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'session_limit' => $request->session_limit,
        ]);

        $a->secteur()->sync($request->secteurs);

        return back()->with('success', 'Abonnement renouvlé avec succés');
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'abonnement' => 'required|numeric',
        ]);

        $a = Abonnement::find($request->abonnement);

        if($a){
            $a->secteur()->detach();
            $a->delete();

            return back()->with('success', 'abonnement supprimé avec succés');
        }

        return back()->with('error', 'abonnement n\'exist pas');
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'nom_abonnement' => 'in:gratuit,bronze,silver,gold,platine,ultra',
            'secteurs' => 'array',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'session_limit' => 'required|numeric',
            'abonnement_id' => 'required|numeric',
        ]);

        $abonnement = Abonnement::findOrFail($request->abonnement_id);

        if($request->nom_abonnement)
            $abonnement->nom_abonnement = $request->nom_abonnement;

        $abonnement->date_debut = $request->date_debut;
        $abonnement->date_fin = $request->date_fin;
        $abonnement->session_limit = $request->session_limit;
        $abonnement->etat = "active";
        
        // $abonnement->secteur()->detach();
        $abonnement->secteur()->sync($request->secteurs);

        $abonnement->save();

        return back()->with('success', 'abonnement modifier avec succés');
    }
}
