<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Auth;

class verificationController extends Controller
{
    public function index(){

        $code = Auth::user()->code;
        $phoneNumber = Auth::user()->phone; 
        $message = 'Votre%20code%20de%20confirmation%20est%20:%20' .$code;
        // Http::get('https://es3.smsalgerie.com/api/json?apikey=f252d2b59c290bb46104085577cdb158a60b5fa1&userkey=4777340f27851c120996a5fe4ad33e1d&function=sms_send&message='. $message .'&to='.$phoneNumber);

        return view('auth.confirmPhone');

    }
    public function check(Request $request){
        $user = Auth::user();
        $code = $user->code;
        if($code == $request->code) {
            $user->update([
                'code' => NULL,
                'phoneVerified' => true,
            ]);

            return redirect()->route('search');

        }
        return view('auth.confirmPhone')->with('error','Le code que vous avez saisie est incorrect.');
    }
}
