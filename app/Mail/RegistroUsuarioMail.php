<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegistroUsuarioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plainPassword;

    public function __construct(User $user, $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

    public function build()
    {
        return $this->subject('Tus credenciales de acceso')
                    ->view('emails.registro_usuario')
                    ->with([
                        'user'     => $this->user,
                        'password' => $this->plainPassword,
                    ]);
    }
}
