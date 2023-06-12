<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Statut;
use App\Models\Wilaya;
use App\Models\Keyword;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function EditPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'old_password' => 'required',
        ]);

        // check if old password match
        if(Hash::check($request->old_password, Auth::user()->password)){
            // checked
            $obj_user = User::find(Auth::id());
            $obj_user->password = Hash::make($request->password);
            $obj_user->save(); 
            
            return back()->with('success' , 'mot de passe a été changer avec Succès');

        }else{
            return back()->with('error' , 'mauvais mot de passe');
        }
    }

    public function editemail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
        ]);

        $user = Auth::user();


        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'email a été changé avec succés');
    }

    public function editphone(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric|unique:users',
        ]);

        $user = Auth::user();


        $user->phone = $request->phone;

        $user->save();

        return back()->with('success', 'telephone a été changé avec succés');
    }

    public function Editnotif(Request $request)
    {
        $this->validate($request, [
            'frequence' => 'required|in:none,everyday,weekly',
            'keyword' => 'nullable|string|max:255',
            'secteur' => 'nullable|array',
            'wilaya' => 'nullable|array',
            'statut' => 'nullable|array',
        ]);

        // creating notif if doesnt exist
        if(!Auth::user()->notif){
            // notif doesnt exist yet so create it
            $notif = Notif::create([
                'user_id' => Auth::id(),
            ]);
        }else{
            $notif = Auth::user()->notif;
        }

        // start editing
        $notif->frequence = $request->frequence;
        
        if($request->statut){
            $statuts = $notif->statut()->whereIn('statuts.statut', $request->statut)->pluck('statut');
            if($statuts){
                $statuts = array_diff($request->statut, $statuts->all());
            }
            $data = [];
            foreach($statuts as $statut){
                $data[] = ['statut' => $statut];
            }

            if($data){
                $notif->statut()->createMany($data);
            }
        }
        
        if($request->wilaya){
            $wilayas = $notif->wilaya()->whereIn('wilayas.wilaya', $request->wilaya)->pluck('wilaya');
            if($wilayas){
                $wilayas = array_diff($request->wilaya, $wilayas->all());
            }
            $data = [];
            foreach($wilayas as $wilaya){
                $data[] = ['wilaya' => $wilaya];
            }

            if($data){
                $notif->wilaya()->createMany($data);
            }
        }

        if($request->keyword){
            $notif->keyword()->updateOrCreate(['keyword' => $request->keyword], ['keyword' => $request->keyword]);
        }

        if($request->secteur){
            $existing_id = $notif->secteur()->whereIn('secteurs.id', $request->secteur)->pluck('secteur_id');
            if($existing_id){
                $notif->secteur()->attach(array_diff($request->secteur, $existing_id->all()));
            }else{
                $notif->secteur()->attach($request->secteur);
            }
        }

        $notif->save();

        return back()->with('success', 'données enregistrer avec succés');

    }

    public function deleteWilaya(Wilaya $wilaya)
    {
        if(Auth::user()->type_user === 'admin' && $wilaya->delete()){
            return 'success';
        }

        if(Auth::user()->notif->id == $wilaya->notif_id && $wilaya->delete()){
            return 'success';
        }
        
        return 'error';
    }

    public function deleteSecteur($id)
    {
        if(Auth::user()->notif->secteur()->detach($id)){
            return 'success';
        }else{
            return 'error';
        }
    }

    public function deleteKeyword(Keyword $keyword)
    {
        if(Auth::user()->type_user === 'admin' && $keyword->delete()){
            return 'success';
        }

        if(Auth::user()->notif->id == $keyword->notif_id && $keyword->delete()){
            return 'success';
        }

        return 'error';
    }

    public function deleteStatut(Statut $statut)
    {
        if(Auth::user()->type_user === 'admin' && $statut->delete()){
            return 'success';
        }

        if(Auth::user()->notif->id == $statut->notif_id && $statut->delete()){
            return 'success';
        }

        return 'error';
    }
    
    public function DemandeAbonnement(Request $request)
    {        
        $this->validate($request, [
            "secteurs" => "required|array",
            'nom_abonnement' => 'required|in:bronze,silver,gold,platine,ultra',
        ]);

        // check if exists

        if(Auth::user()->pending_abonnement){
            // it exsits so update
            $abonnement = Auth::user()->pending_abonnement;
            $abonnement->nom_abonnement = $request->nom_abonnement;

            $abonnement->secteur()->sync($request->secteurs);

            $abonnement->save();
        }else{
            // it doesnt exsit so create
            $abonnement = Abonnement::create([
                'user_id' => Auth::id(),
                'nom_abonnement' => $request->nom_abonnement,
                'date_debut' => Carbon::today(),
                'date_fin' => Carbon::today(),
                'etat' => 'pending',
            ]);

            $abonnement->secteur()->sync($request->secteurs);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'abonnement' => $abonnement->nom_abonnement,
                'secteurs' => $abonnement->secteur,
            ],
        ]);
        
    }
}
