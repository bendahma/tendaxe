<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offre;
use App\Models\Adminetab;
use App\Models\Journalar;
use App\Models\Journalfr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class OffreController extends Controller
{
    public function index(Request $resquest)
    {
        $offres = null;

        if(Auth::user()->type_user === "admin"){
            $offres = Offre::where('etat', 'active')->latest()->paginate(5);
        }

        if(Auth::user()->type_user === "publisher" || Auth::user()->type_user === "content"){
            $offres = Auth::user()->offre()->latest()->paginate(5);
        }

        return view('admin.offers', [
            'offres' => $offres,
        ]);
    }

    public function trashed()
    {
        $offres = Offre::onlyTrashed()->latest('deleted_at')->paginate(5);

        return view('admin.trash', [
            'offres' => $offres,
        ]);
    }

    public function editform($offre_id)
    {
        // get offre infos 
        $offre = Offre::where('id', $offre_id)->with('secteur','user')->first();

        if(!$offre)
            return abort(404);
        
        if(Auth::user()->type_user === "publisher" && $offre->user_id != Auth::id()){
            return abort(403);
        }

        $secteurs = $offre->secteur->pluck('id')->toArray();

        //dd($secteurs);

        $etab = null;

        if($offre->user->type_user === "content"){
            $etab = $offre->user->etablissement;
        }

        if($offre->user->type_user === "admin"){
            $etab = $offre->adminetab;
        }
        
        return view('admin.edit_offer', [
            "offre" => $offre,
            "etab" => $etab,
            "secteurs" => $secteurs,
            "user_type" => $offre->user->type_user,
        ]);
    }

    public function edit(Request $request, $offre_id)
    {
        // get offre infos 
        $offre = Offre::where('id', $offre_id)->with('secteur','user')->first();

        if(Auth::user()->type_user === "publisher" && $offre->user_id != Auth::id()){
            return abort(403);
        }

        // validation
        $this->validate($request, [
            'titre' => 'required',
            'description' => 'nullable',
            'date_pub' => 'required|date',
            'date_lim' => 'required|date',
            'secteur' => 'required|array',
            'statut' => 'required|max:255',
            'type' => 'in:national,international',
            'wilaya_offre' => 'max:255',
            'prix' => 'nullable|numeric',
            'etab' => 'required|numeric',
            'journal_ar' => 'required|numeric',
            'journal_fr' => 'required|numeric',
            'photo' => 'required_if:description,value|mimes:jpeg,jpg,png|max:100000', // max 10000kb
            'photo2' => 'required_if:description,value|mimes:jpeg,jpg,png|max:100000', // max 10000kb
            ]);
        
        // update common infos
        $offre->titre = $request->titre;
        $offre->description = $request->description;
        $offre->date_pub = $request->date_pub;
        $offre->date_limit = $request->date_lim;
        $offre->type = $request->type;
        $offre->prix = $request->prix;
        $offre->statut = $request->statut;
        
        if($request->wilaya_offre === "Aucun"){
            $offre->wilaya = ($request->wilaya_etab !== "Aucun") ? $request->wilaya_etab : null;
            if($request->etab != 0){
                // get etab wilaya
                $offre->wilaya = DB::table('adminetabs')->where('id', $request->etab)->pluck('wilaya')[0];
            }
        }else{
            $offre->wilaya = $request->wilaya_offre;
        }

        // check if new jornal is sent
        if($request->journal_ar == 0){
            $id_ar = $this->AddJournal($request, "ar");
        }elseif($request->journal_ar == -1){
            $id_ar = null;
        }else{
            $id_ar = $request->journal_ar;
        }

        if($request->journal_fr == 0){
            $id_fr = $this->AddJournal($request, "fr");
        }elseif($request->journal_fr == -1){
            $id_fr = null;
        }else{
            $id_fr = $request->journal_fr;
        }

        // update journals
        $offre->journalar_id = $id_ar;
        $offre->journalfr_id = $id_fr;

        // update etab
        if($offre->adminetab_id){
             // add new etab
            if($request->etab == 0){
                // create the new etablissement

                $this->validate($request, [
                    'nom_etab' => 'max:512',
                    // 'category' => 'required|max:255',
                    'wilaya_etab' => 'max:255',
                    'commune_etab' => 'max:255',
                    'email_etab' => 'max:255',
                    'fix' => 'max:255',
                    'fax' => 'max:255',
                    'logo' => 'mimes:jpeg,jpg,png|max:10000',
                ]);

                $fileName = null;

                if ($request->hasFile('logo')) {
                    $image      = $request->file('logo');
                    $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();

                    $img = Image::make($image->getRealPath());
                    $img->resize(150, 150);

                    $img->stream(); // <-- Key point

                    // dd($fileName);
                    Storage::disk('local')->put('public/logo/' . $fileName, $img);
                }

                // if($request->category !== "AUTRE"){
                //     // $nom_etab = "$request->category $request->commune_etab de la wilaya $request->wilaya_etab"; 

                //     $nom_etab = $request->category;
                //     if($request->commune_etab !== "Aucun")
                //         $nom_etab .= " $request->commune_etab";
                    
                //     if($request->wilaya_etab !== "Aucun")
                //         $nom_etab .= " de la wilaya $request->wilaya_etab";

                // }

                $etab = Adminetab::create([
                    'nom_etablissement' => $request->nom_etab,
                    'category' => "AUTRE",
                    'wilaya' => ($request->wilaya_etab !== "Aucun") ? $request->wilaya_etab : null,
                    'commune' => ($request->commune_etab !== "Aucun") ? $request->commune_etab : null,
                    'email' => $request->email_etab,
                    'fix' => $request->fix,
                    'fax' => $request->fax,
                    'logo' => $fileName,
                ]);

                // dd($etab);

                if(!$etab){
                    // etab not inserted delete the img
                    Storage::delete('public/logo/' . $fileName);

                    return back()->with('error', 'etab not inserted');
                }

                $etab_id = $etab->id;
            }else{
                $etab_id = $request->etab;
            }
            
            $offre->adminetab_id = $etab_id;

        }

        // update secteurs
        $offre->secteur()->detach();
        $offre->secteur()->sync($request->secteur);

        // update files
        $fileName = null;

        // upload offer img
        if ($request->hasFile('photo')) {
            // delete old img
            if($offre->img_offre){
                Storage::delete('public/' . $offre->img_offre);
            }

            $image      = $request->file('photo');
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
            
            $img = Image::make($image->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->stream(); // <-- Key point

            // dd($fileName);
            Storage::disk('local')->put('public/' . $fileName, $img);
            
            // update img file
            $offre->img_offre = $fileName;
        }

        $fileName2 = null;

        if ($request->hasFile('photo2')) {
            // delete old img
            if($offre->img_offre2){
                Storage::delete('public/' . $offre->img_offre2);
            }
            $image      = $request->file('photo2');
            $fileName2   = uniqid() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->stream(); // <-- Key point

            // dd($fileName2);
            Storage::disk('local')->put('public/' . $fileName2, $img);

            // update img file
            $offre->img_offre2 = $fileName2;
        }

        $offre->save();

        return redirect()->route('admin.offers')->with('success', 'offre modifier avec succés');
    }

    public function addform()
    {
        return view('admin.add_offer');
    }

    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'titre' => 'required',
            'description' => 'nullable',
            'date_pub' => 'required|date',
            'date_lim' => 'required|date',
            'secteur' => 'required|array',
            'statut' => 'required|max:255',
            'wilaya_offre' => 'max:255',
            'type' => 'in:national,international',
            'prix' => 'nullable|numeric',
            'etab' => 'required|numeric',
            'journal_ar' => 'required|numeric',
            'journal_fr' => 'required|numeric',
            'photo' => 'required_if:description,value|mimes:jpeg,jpg,png|max:100000', // max 10000kb
            'photo2' => 'required_if:description,value|mimes:jpeg,jpg,png|max:100000', // max 10000kb
            ]);
        
        // check if new jornal is sent
        if($request->journal_ar == 0){
            $id_ar = $this->AddJournal($request, "ar");
        }elseif($request->journal_ar == -1){
            $id_ar = null;
        }else{
            $id_ar = $request->journal_ar;
        }

        if($request->journal_fr == 0){
            $id_fr = $this->AddJournal($request, "fr");
        }elseif($request->journal_fr == -1){
            $id_fr = null;
        }else{
            $id_fr = $request->journal_fr;
        }


        // add new etab
        if($request->etab == 0){
            // create the new etablissement

            $this->validate($request, [
                'nom_etab' => 'max:512',
                // 'category' => 'required|max:255',
                'wilaya_etab' => 'max:255',
                'commune_etab' => 'max:255',
                'email_etab' => 'max:255',
                'fix' => 'max:255',
                'fax' => 'max:255',
                'logo' => 'mimes:jpeg,jpg,png|max:10000',
            ]);

            $fileName = null;

            if ($request->hasFile('logo')) {
                $image      = $request->file('logo');
                $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(150, 150);

                $img->stream(); // <-- Key point

                // dd($fileName);
                Storage::disk('local')->put('public/logo/' . $fileName, $img);
            }

            // if($request->category !== "AUTRE"){
            //     // $nom_etab = "$request->category $request->commune_etab de la wilaya $request->wilaya_etab"; 

            //     $nom_etab = $request->category;
            //     if($request->commune_etab !== "Aucun")
            //         $nom_etab .= " $request->commune_etab";
                
            //     if($request->wilaya_etab !== "Aucun")
            //         $nom_etab .= " de la wilaya $request->wilaya_etab";

            // }

            $etab = Adminetab::create([
                'nom_etablissement' => $request->nom_etab,
                'category' => "AUTRE",
                'wilaya' => ($request->wilaya_etab !== "Aucun") ? $request->wilaya_etab : null,
                'commune' => ($request->commune_etab !== "Aucun") ? $request->commune_etab : null,
                'email' => $request->email_etab,
                'fix' => $request->fix,
                'fax' => $request->fax,
                'logo' => $fileName,
            ]);

            // dd($etab);

            if(!$etab){
                // etab not inserted delete the img
                Storage::delete('public/logo/' . $fileName);

                return back()->with('error', 'etab not inserted');
            }

            $etab_id = $etab->id;
        }else{
            $etab_id = $request->etab;
        }

        $fileName = null;

        // upload offer img
        if ($request->hasFile('photo')) {
            $image      = $request->file('photo');
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->stream(); // <-- Key point

            // dd($fileName);
            Storage::disk('local')->put('public/' . $fileName, $img);
        }

        $fileName2 = null;

        if ($request->hasFile('photo2')) {
            $image      = $request->file('photo2');
            $fileName2   = uniqid() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->stream(); // <-- Key point

            // dd($fileName2);
            Storage::disk('local')->put('public/' . $fileName2, $img);
        }

        $wilaya = null;

        if($request->wilaya_offre === "Aucun"){
            $wilaya = ($request->wilaya_etab !== "Aucun") ? $request->wilaya_etab : null;
            if($request->etab != 0){
                // get etab wilaya
                $wilaya = DB::table('adminetabs')->where('id', $request->etab)->pluck('wilaya')[0];
            }
        }else{
            $wilaya = $request->wilaya_offre;
        }

        $offre = Offre::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'statut' => $request->statut,
            'type' => $request->type,
            'wilaya' => $wilaya,
            'prix' => $request->prix,
            'description' => $request->description,
            'date_pub' => $request->date_pub,
            'date_limit' => $request->date_lim,
            'img_offre' => $fileName,
            'img_offre2' => $fileName2,
            'adminetab_id' => $etab_id,
            'journalar_id' => $id_ar,
            'journalfr_id' => $id_fr,
            'etat' => "active",
        ]);

        $offre->secteur()->sync($request->secteur);

        return redirect()->route('admin.offers');
    
    }

    private function AddJournal($request, $lang)
    {
        $fileName = null;

        if($lang === "ar"){
            $this->validate($request, [
                'nom_journal_ar' => 'required|max:100',
                'logo_journal_ar' => 'mimes:jpeg,jpg,png|max:10000',
            ]);

            // upload logo
            if ($request->hasFile('logo_journal_ar')) {
                $image      = $request->file('logo_journal_ar');
                $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
    
                $img = Image::make($image->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
    
                $img->stream(); // <-- Key point
    
                Storage::disk('local')->put('public/journal/' . $fileName, $img);
            }

            $journal = Journalar::create([
                'nom' => $request->nom_journal_ar,
                'logo' => $fileName,
            ]);

            if($journal){
                return $journal->id;
            }else{
                return back()->with('error', 'try again');
            }
            
        }

        if($lang === "fr"){
            $this->validate($request, [
                'nom_journal_fr' => 'required|max:100',
                'logo_journal_fr' => 'mimes:jpeg,jpg,png|max:10000',
            ]);

            // upload logo
            if ($request->hasFile('logo_journal_fr')) {
                $image      = $request->file('logo_journal_fr');
                $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
    
                $img = Image::make($image->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
    
                $img->stream(); // <-- Key point
    
                Storage::disk('local')->put('public/journal/' . $fileName, $img);
            }

            $journal = Journalfr::create([
                'nom' => $request->nom_journal_fr,
                'logo' => $fileName,
            ]);

            if($journal){
                return $journal->id;
            }else{
                return back()->with('error', 'try again');
            }
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request,[
            'offre' => 'required|numeric',
        ]);

        if(Auth::user()->type_user === "admin"){
            // get offer
            $offre = Offre::withTrashed()->find($request->offre);
    
            // check if contains imgs & delete them
            if($offre->img_offre){
                // delete img
                Storage::delete('public/' . $offre->img_offre);
            }
    
            if($offre->img_offre2){
                // delete img
                Storage::delete('public/' . $offre->img_offre2);
            }
    
            $offre->secteur()->detach();
    
            $offre->forceDelete();
    
            return back()->with('success', 'offre supprimer');
        }

        if(Auth::user()->type_user === "publisher"){
            // soft-delete
            $offre = Offre::find($request->offre);

            $offre->delete();

            return back()->with('success', 'offre supprimer');
        }

        if(Auth::user()->type_user === "content"){
            $offre = Offre::find($request->offre);
            
            // check if owner
            if($offre->user_id != Auth::id())
                return abort(403);

            $offre->delete();

            return back()->with('success', 'offre supprimer');
        }
    }

    public function restore(Request $request)
    {
        $this->validate($request,[
            'offre' => 'required|numeric',
        ]);

        $offre = Offre::withTrashed()->find($request->offre);

        $offre->restore();

        return back()->with('success', 'offre restoré');
    }

    public function pending()
    {
        $offres = Offre::where('etat', 'pending')->latest()->paginate(5);

        return view('admin.pending', [
            'offres' => $offres,
        ]);
    }

    public function accept(Request $request)
    {
        $this->validate($request,[
            'offre' => 'required|numeric',
        ]);

        $offre = Offre::find($request->offre);

        if($offre){
            $offre->etat = 'active';
            $offre->save();
            return back()->with('success', 'offre accepté');
        }else{
            return back()->with('error', 'offre n\'existe pas');
        }
    }
}
