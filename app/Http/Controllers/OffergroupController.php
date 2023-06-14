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
        return view('admin.add_imgs_offer_group');
    }



    public function addgroupofferlist(Request $request)
    {

        // $validatedData = $request->validate([
        //     'pictures' => 'required',
        // ]);

        $files = $request->file('images');
        foreach($files as $picture) {
            $fileName = time() . '_' . $picture->getClientOriginalName();
            $filePath = $picture->storeAs('public',$picture->getClientOriginalName());
            // $img = Image::make($picture->getRealPath());

            // $img->resize(1200, 1200, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });
    
            TempOffer::create([
                'titre' => $picture->getClientOriginalName(),
                'img_offre' => $filePath,
                'statut' => 'pendding',
                'user_id' => auth()->user()->id,
            ]);

            // Storage::disk('local')->put('public/tempOffers' . $fileName, $img);
        }

        $penddingOffers = TempOffer::paginate(25);

        return view('admin.add_offers_group_list')->with('penddingOffers',$penddingOffers);
    }

    public function penddingOffers(){
        $penddingOffers = TempOffer::paginate(25);

        return view('admin.add_offers_group_list')->with('penddingOffers',$penddingOffers);
    }





    public function addgroupoffer(Request $request)

    {

        dd($request->all());
    }

}

