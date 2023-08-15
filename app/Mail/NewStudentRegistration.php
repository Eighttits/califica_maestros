<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewStudentRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $temporaryPassword;

    public function __construct($email, $temporaryPassword)
    {
        $this->email = $email;
        $this->temporaryPassword = $temporaryPassword;
    }

    public function build()
    {
        return $this->markdown('vendor.notifications.new-student-registration')
                    ->subject('Registro Exitoso');
    }
}