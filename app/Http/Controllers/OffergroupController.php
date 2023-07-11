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
        $groupOffersCount = TempOffer::where('user_id',auth()->user()->id)->count();
        return view('admin.add_imgs_offer_group')->with('groupOffersCount',$groupOffersCount);
    }



    // public function addgroupofferlist(Request $request)
    // {
    //     $files = $request->file('images');
    //     foreach($files as $image) {
    //         $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();
    //         $img = Image::make($image->getRealPath());
    //         $img->resize(1200, 1200, function ($constraint) {
    //             $constraint->aspectRatio();
    //             $constraint->upsize();
    //         });
    //         $img->stream();
    //         Storage::disk('local')->put('public/' . $fileName, $img);
    //         TempOffer::create([
    //             'titre' => $image->getClientOriginalName(),
    //             'img_offre' => $fileName,
    //             'statut' => 'pendding',
    //             'user_id' => auth()->user()->id,
    //         ]);
    //     }
    //     return redirect()->route('admin.offers.penddingOffers');
    // }

//     public function addgroupofferlist(Request $request)
// {
//     $files = $request->file('images');
//     $watermarkPath = public_path('img\watermark.png'); 
    
//     foreach($files as $image) {
//         $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
//         $img = Image::make($image->getRealPath());
//         $img->resize(1200, 1200, function ($constraint) {
//             $constraint->aspectRatio();
//             $constraint->upsize();
//         });

//         // Apply watermark
//         $img->insert($watermarkPath, 'center');

//         // Save the image with watermark
//         $img->save(public_path('storage/' . $fileName));

//         TempOffer::create([
//             'titre' => $image->getClientOriginalName(),
//             'img_offre' => $fileName,
//             'statut' => 'pending',
//             'user_id' => auth()->user()->id,
//         ]);
//     }

//     return redirect()->route('admin.offers.penddingOffers');
// }

    public function addgroupofferlist(Request $request)
    {
        $files = $request->file('images');
        $watermarkPath = public_path('img/watermark.png'); // Replace with actual path to your watermark image

        foreach ($files as $image) {
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize the image
            $img = Image::make($image->getRealPath())->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Apply the watermark
            $watermark = Image::make($watermarkPath)->opacity(100);
            $img->insert($watermark, 'center');

            // Save the watermarked image
            Storage::disk('public')->put($fileName, $img->stream());

            TempOffer::create([
                'titre' => $image->getClientOriginalName(),
                'img_offre' => $fileName,
                'statut' => 'pending',
                'user_id' => auth()->user()->id,
            ]);
        }

        return redirect()->route('admin.offers.penddingOffers');
    }

    public function penddingOffers(){
        $pendingOffers = TempOffer::where('user_id',auth()->user()->id)->get();
        return view('admin.add_offers_group_list')->with('pendingOffers',$pendingOffers);
    }





    public function addgroupoffer(Request $request)

    {

        dd($request->all());
    }

}

