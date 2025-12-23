<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetpasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    
    private $user;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Lấy lại tài khoản web truyện '.env('APP_URL'))
        ->view('mails.resetpassword')
        ->with([
            'user' => $this->user,
            'token' => $this->token
        ]);
    }
}
