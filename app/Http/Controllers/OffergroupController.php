<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;
use App\Models\TempOffer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Adminetab;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OffergroupController extends Controller

{

    public function index()

    {
        $groupOffersCount = TempOffer::count();
        return view('admin.add_imgs_offer_group')->with('groupOffersCount',$groupOffersCount);
    }



    public function addgroupofferlist(Request $request)
    {
        $files = $request->file('images');
        foreach($files as $image) {
            $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->stream();
            Storage::disk('local')->put('public/' . $fileName, $img);
            TempOffer::create([
                'titre' => $image->getClientOriginalName(),
                'img_offre' => $fileName,
                'statut' => 'pendding',
                'user_id' => auth()->user()->id,
            ]);
        }
        return redirect()->route('admin.offers.penddingOffers');
    }

    public function penddingOffers(){
        $pendingOffers = TempOffer::all();
        return view('admin.add_offers_group_list')->with('pendingOffers',$pendingOffers);
    }





    public function addgroupoffer(Request $request)

    {

        dd($request->all());
    }

}

