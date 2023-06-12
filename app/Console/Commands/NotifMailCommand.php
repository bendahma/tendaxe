<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Notif;
use App\Models\Offre;
use App\Mail\NotifMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:NotifMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $notifs = Notif::where("frequence", "everyday")->with('user', 'secteur', 'wilaya', 'keyword', 'statut')->get();
        
        if($notifs->isNotEmpty()){
            foreach($notifs as $notif){
                $offres = Offre::whereDate('created_at', Carbon::today());
                // $offres = new Offre();

                if($notif->wilaya->isNotEmpty()){
                    $offres = $offres->whereIn('wilaya', $notif->wilaya()->pluck('wilaya'));
                }

                if($notif->statut->isNotEmpty()){
                    $offres = $offres->whereIn('statut', $notif->statut()->pluck('statut'));
                }

                if($notif->secteur->isNotEmpty()){
                    $sect_ids = $notif->secteur()->pluck('secteurs.id');
                    $offres = $offres->whereHas('secteur', function($q) use($sect_ids) {
                        $q->whereIn('secteur_id', $sect_ids);
                    });
                }

                if($notif->keyword->isNotEmpty()){
                    $keywords = $notif->keyword()->pluck('keyword');
                    $offres = $offres->where(function ($q) use ($keywords) {
                        collect($keywords)->each(function ($keyword) use ($q) {
                          $q->orWhere('titre', 'like', '%'. $keyword .'%');
                        });
                    });
                }

                $offres = $offres->get();

                $expired = true;
                if($notif->user->current_abonnement){
                    $expired = false;
                }

                if($offres->isNotEmpty()){
                    Mail::to($notif->user->email)->send(new NotifMail($offres, $expired));
                }
            }
        }

        // $offres = Offre::inRandomOrder()->limit(5)->get();
        // Mail::to("emo.name95@gmail.com")->send(new NotifMail($offres));
    }
}
