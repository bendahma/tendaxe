<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AdminPhoneNotification ;
use App\Models\User ;
use Illuminate\Support\Facades\Mail;
use App\Mail\PhoneVerificationEmail;

use Auth;

class verificationController extends Controller
{
    public function index(){

        $user = Auth::user();

        $code = $user->code;
        $phoneNumber = $user->phone; 
        $message = 'Votre%20code%20de%20confirmation%20est%20:%20' .$code;
        
        // Http::get('https://es3.smsalgerie.com/api/json?apikey=f252d2b59c290bb46104085577cdb158a60b5fa1&userkey=4777340f27851c120996a5fe4ad33e1d&function=sms_send&message='. $message .'&to='.$phoneNumber);
        
        // User phone verifications attempts
        $nt = $user->attempt + 1 ;
        $user->update([
            'attempt' => $nt ,
        ]);
        $attempt = $user->attempt;

        $notificationStatus = $attempt < 3 ? false : true ;
        // dd($notificationStatus);
        return view('auth.confirmPhone')->with('notificationSend',$notificationStatus)
                                        ->with('success','Nous avons reçu votre demande et nous vous appellerons le plus possible à ' . $user->phone . ' pour confirmé votre numéro de téléphone.')
                                        ->with('attempt',$attempt)
                                        ->with('user',$user);

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
        return view('auth.confirmPhone')->with('user',$user)
                                        ->with('notificationSend',false)
                                        ->with('error','Le code que vous avez saisie est incorrect.');
    }

    public function notification() {
        $adminPhoneNotification = AdminPhoneNotification::where('seen',false)->orderBy('created_at','DESC')->paginate(10);
        return view('admin.phone')->with('adminPhoneNotification',$adminPhoneNotification);
    }

    public function sendNotification(User $user){

        $check = AdminPhoneNotification::where('user_id',$user->id)->count();

        if($check == 0) {

            AdminPhoneNotification::create([
                'user_id' => $user->id,
                'seen' => false
            ]);
    
            $admins = User::where('type_user','Super admin')->get();
            
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new PhoneVerificationEmail($user));
            }
        }
        
        return view('auth.confirmPhone')->with('user',$user)
                                        ->with('notificationSend',true)
                                        ->with('success','Nous avons reçu votre demande et nous vous appellerons le plus possible à ' . $user->phone . ' pour confirmé votre numéro de téléphone.');

    }
    
    public function confirmation(User $user){
        
        $user->update([
            'phoneVerified' => true,
            'code' => NULL,
        ]);

        AdminPhoneNotification::where('user_id',$user->id)->delete();
        
        $adminPhoneNotification = AdminPhoneNotification::where('seen',false)->orderBy('created_at','DESC')->paginate(10);

        return view('admin.phone')->with('adminPhoneNotification',$adminPhoneNotification)
                                        ->with('confirmation',true)
                                        ->with('message','Le numéro téléphone à été confirmé avec success');

    }

    


}
