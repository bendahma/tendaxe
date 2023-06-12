<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('type_user', '=' , 'admin')
                    ->orwhere('type_user', '=' , 'publisher')
                    ->latest()->paginate(5);
        
        return view('admin.admins', [
            'users' => $users, 
        ]);
    }
    
    public function store(Request $request)
    {
        // dd('hi');

        $this->validate($request, [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'phone' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
            'type_admin' => 'required|in:admin,publisher',
            ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_user' => $request->type_admin,
            'etat' => "active",
            'email_verified_at' => Carbon::now(),
        ]);

        if($user){
            return redirect()->route('admin.admins')->with('success', 'admin bien ajouté');
        }else{
            return back()->with('error', 'error veuillez resseyé');
        }
    }
}
