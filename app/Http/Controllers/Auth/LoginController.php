<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {        
        // validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        // login
        if(!Auth::attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('error', 'mauvais e-mail ou mot de passe');
        }

        if(Auth::user()->type_user === "Super admin" || Auth::user()->type_user === "admin"){
            return redirect()->route('dashboard');
        }
        
        if(Auth::user()->type_user === "publisher"){
            if(Auth::user()->etat === "desactive"){
                Auth::logout();
                return redirect()->route('suspended');
            }else{
                return redirect()->route('dashboard');
            }
        }

        if(Auth::user()->type_user === "content"){
            return redirect()->route('rep.dashboard');

            // if(Auth::user()->etat === "desactive"){
            //     Auth::logout();
            //     return redirect()->route('suspended');
            // }else{
            //     return redirect()->route('rep.dashboard');
            // }
        }

        
        // if(Auth::user()->etat === "desactive"){
            //     Auth::logout();
            
            //     return redirect()->route('suspended');
            // }
            
        if(Auth::user()->type_user === "abonné" && !Auth::user()->phoneVerified ){
            return redirect()->route('phone.verification');
        }
        return redirect()->route('search');
    }
}
