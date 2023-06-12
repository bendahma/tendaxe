<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Notif;
use Anam\Captcha\Captcha;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index($choice = null)
    {
        return view('auth.inscription');

        // if($choice == 1){
        //     return view('auth.inscription');
        // }

        // if($choice == 2){
        //     return view('auth.inscription2');
        // }

        // return view('auth.choice');
    }

    public function store(Request $request, Captcha $captcha, $choice = 1)
    {
        $response = $captcha->check($request);

        if (! $response->isVerified()) {
            return back()->with('error', 'Captcha Non-valide!');
        }

        // abonné
        if($choice == 1){
             // validation
            $this->validate($request, [
                'nom' => 'required|max:255',
                'prenom' => 'required|max:255',
                'nom_entreprise' => 'required|max:255',
                'phone' => 'required|max:255|unique:users',
                'wilaya' => 'required|max:255',
                // 'commune' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed'
                ]);
                
            // store user
            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'nom_entreprise' => $request->nom_entreprise,
                'phone' => $request->phone,
                'wilaya' => $request->wilaya,
                'commune' => null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'etat' => 'active',
            ]);

            $abonnement = Abonnement::create([
                'user_id' => $user->id,
                'nom_abonnement' => 'gratuit',
                'date_debut' => Carbon::now(),
                'date_fin' => Carbon::now()->addDays(3),
            ]);
            
            // create an empty notif
            $notif = Notif::create([
                'user_id' => $user->id,
            ]);

            event(new Registered($user));
            
            // login and redirect to profile
            Auth::attempt($request->only('email', 'password'));
            return redirect()->route('search');

            // redirect
            // return redirect()->route('login');
        }   
        
        // createur de contenu
        // if($choice == 2){
        //     $this->validate($request, [
        //         'nom' => 'required|max:255',
        //         'prenom' => 'required|max:255',
        //         'phone' => 'required|max:255|unique:users',
        //         'email' => 'required|email|max:255|unique:users',
        //         'nom_etab' => 'max:255',
        //         'category' => 'required|max:255',
        //         'wilaya_etab' => 'required|max:255',
        //         'commune_etab' => 'required|max:255',
        //         'email_etab' => 'max:255',
        //         'fix' => 'max:255',
        //         'fax' => 'max:255',
        //         'logo' => 'mimes:jpeg,jpg,png|max:10000',
        //         ]);
        //         $fileName = null;

        //         if ($request->category === "AUTRE" && $request->hasFile('logo')) {
        //             $image      = $request->file('logo');
        //             $fileName   = time() . '.' . $image->getClientOriginalExtension();
    
        //             $img = Image::make($image->getRealPath());
        //             $img->resize(150, 150);
    
        //             $img->stream(); // <-- Key point
    
        //             // dd($fileName);
        //             Storage::disk('local')->put('public/logo/' . $fileName, $img);
        //         }

        //         if($request->category !== "AUTRE")
        //             $nom_etab = "$request->category $request->commune_etab de la wilaya $request->wilaya_etab"; 

        //     $etab = Etablissement::create([
        //         'nom_etablissement' => ($request->category === "AUTRE") ? $request->nom_etab : $nom_etab,
        //         'category' => $request->category,
        //         'wilaya' => $request->wilaya_etab,
        //         'commune' => $request->commune_etab,
        //         'email' => $request->email_etab,
        //         'fix' => $request->fix,
        //         'fax' => $request->fax,
        //         'logo' => $fileName,
        //     ]);
            
        //     if(!$etab){
        //         return back()->with('status', 'erreur, Veuillez réessayer');
        //     }

        //     $user = User::create([
        //         'nom' => $request->nom,
        //         'prenom' => $request->prenom,
        //         'phone' => $request->phone,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //         'etablissement_id' => $etab->id,
        //         'type_user' => 'content',
        //     ]);

        //     if(!$user){
        //         $etab->delete();
        //         return back()->with('status', 'erreur, Veuillez réessayer');
        //     }
            
        //     return view('auth.login');

        // }
    }
}
