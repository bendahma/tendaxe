<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DeviceManagerController extends Controller
{
    public function index()
    {
        $devices = DB::table('sessions')
        ->where('user_id', Auth::user()->id)
        ->get()->reverse();

        return view('user.device_manager')
            ->with('devices', $devices)
            ->with('current_session_id', Session::getId());
    }

    public function logout_single(Request $request, $device_id)
    {
        DB::table('sessions')
        ->where('id', $device_id)->delete();

        return redirect('/');
    }

    public function logout_all(Request $request)
    {
        DB::table('sessions')
        ->where('user_id', Auth::user()->id)
        ->where('id', '!=', Session::getId())->delete();

        return redirect('/');

    }
}
