<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;
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
        $validatedData = $request->validate([
            'pictures' => 'required',
        ]);
        $Array_pictures = [];
        $Array_pic_names = [];
        foreach ($validatedData['pictures'] as $picture) {
            $fileName2   =  $picture->getClientOriginalName();


            $img = Image::make($picture->getRealPath());
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->stream(); // <-- Key point

            // dd($fileName2);
            Storage::disk('local')->put('public/' . $fileName2, $img);


            array_push($Array_pictures, $picture);
            array_push($Array_pic_names, $fileName2);
        }



        return view('admin.add_offers_group_list', compact(['Array_pictures', 'Array_pic_names']));

    }


    public function addgroupoffer(Request $request)
    {
        $titles = $request->input('titre');
        $desc = $request->input('description');
        $date_pub = $request->input('date_pub');
        $date_lim = $request->input('date_lim');
        $journal_fr = $request->input('journal_fr');
        $wilaya_offre = $request->input('wilaya_offre');
        $statuts = $request->input('statut');
        $etabs = $request->input('etab');
        $dim = count($titles);
        $jornals = [];
        for ($i = 0; $i < $dim; $i++) {

            /*validation
            $this->validate($request, [
                'titre' => 'required',
                'description' => 'nullable',
                'date_pub' => 'required|date',
                'date_lim' => 'required|date',
                'wilaya_offre' => 'max:255',



                'journal_fr' => 'required|numeric',

            ]);

            /* check if new jornal is sent
            if ($request->journal_ar == 0) {
                $id_ar = $this->AddJournal($request, "ar");
            } elseif ($request->journal_ar == -1) {
                $id_ar = null;
            } else {
                $id_ar = $request->journal_ar;
            }
            */


            if ($journal_fr[$i] == 0) {
                $id_fr = null;
            } elseif ($journal_fr[$i] == -1) {
                $id_fr = null;
            } else {
                $id_fr = $journal_fr[$i];
            }
            array_push( $jornals, $id_fr);


            $fileName = null;

            /* upload offer img
            if ($request->hasFile('photo')) {
                $image      = $request->file('photo');
                $fileName   = uniqid() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->stream(); // <-- Key point

                // dd($fileName);
                Storage::disk('local')->put('public/' . $fileName, $img);
            }

            $fileName2 = null;

            if ($request->hasFile('photo2')) {
                $image      = $request->file('photo2');
                $fileName2   = uniqid() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->stream(); // <-- Key point

                // dd($fileName2);
                Storage::disk('local')->put('public/' . $fileName2, $img);
            }*/

            $wilaya = [];
            if ($wilaya_offre[$i] === "Aucun") {
                $wilaya = Auth::user()->adminetab->wilaya;
            } else {
                $wilaya = $wilaya_offre[$i];
            }
        };

       $offers =[];
        for ($i = 0; $i < $dim; $i++){

            $offre = [
                'user_id' => Auth::id(),
                'titre' => $titles[$i],
                'statut' => $statuts[$i],
                'type' => 'national',
                'wilaya' => $wilaya,
                //'prix' => $request->prix,
                'description' => $desc[$i],
                'date_pub' => $date_pub[$i],
                'date_limit' => $date_lim[$i],
                'img_offre' => $fileName,
                //'img_offre2' => $fileName2,
                //'journalar_id' => $id_ar,
                'journalfr_id' => $jornals[$i],
                'adminetab_id' => 1,
            ];

            array_push($offers,$offre);

            //$offre->secteur()->sync($request->secteur);

        };


        foreach($offers as $newoffre){
            Offre::create($newoffre);
        };


        return redirect()->route('user.offers')->with('success', 'offre ajouté');
    }
}
