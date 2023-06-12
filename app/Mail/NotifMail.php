<?php

namespace App\Mail;

use App\Models\Offre;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifMail extends Mailable
{
    use Queueable, SerializesModels;

    public $offres, $expired;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($offres, $expired)
    {
        $this->offres = $offres;
        $this->expired = $expired;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $offres = Offre::inRandomOrder()->limit(5)->get();

        return $this->subject('TendAXE | Notification')
                    ->view('emails.notif', [
                        'offres' => $this->offres,
                        'expired' => $this->expired,
                    ]);
    }
}
