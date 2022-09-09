<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AceptacionMailable extends Mailable
{
    use Queueable, SerializesModels;


    public $subject = "Información almecenada a tratar.";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        session_start();
        $user = Http::retry(20, 300)->withToken($_SESSION['B1SESSION'])->get("https://10.170.20.95:50000/b1s/v1/BusinessPartners('".$_SESSION['CODUSER']."')")->json();
        $direcciones = $user['BPAddresses'];
        $contactos = $user['ContactEmployees'];
        // dd($user);

        return $this->view('Emails.Aceptacion', compact('user', 'direcciones', 'contactos'));
    }
}
