<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{
    public function index()
    {
        $offres = Auth::user()->favorite(Offre::class);
        return view('offers.favoris', [
            'offres' => $offres,
            'expired' => !(Auth::user()->current_abonnement),
        ]);
    }

    public function toggle(Offre $offre)
    {
        $offre->toggleFavorite();

        return back();
    }

    public function store(Offre $offre)
    {
        # code...
    }

    public function destroy(Offre $offre)
    {
        # code...
    }
}
