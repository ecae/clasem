<?php

namespace App\Mail;

use App\Persona;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class AlertaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $asunto;
    public $ncompletos;
    public $equipo;
    public $limite;
    public $mantenimiento;

    /*
     *
     public function __construct($mensaje,$asunto)
    {
        $this->mensaje=$mensaje;
        $this->asunto=$asunto;
    }
     */
    public function __construct($asunto,$ncompletos,$equipo,$mantenimiento,$limite)
    {

        $this->asunto=$asunto;
        $this->ncompletos=$ncompletos;
        $this->equipo=$equipo;
        $this->mantenimiento=$mantenimiento;
        $this->limite=$limite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*
        $id_user=Auth::user()->id;
        $emails=Persona::select(['personas.email'])
            ->join('users','users.id','=','personas.id')
            ->where('users.id','=',$id_user)
            ->get();

        $user_email='';
        foreach ($emails as $email){
            $user_email=$email->email;
        }
        */
        /*
         return $this->view('emails.enviarAlerta')
                    ->subject($this->asunto)
                    ->from('sisman-clasem@gmail.com');
         */
        return $this->view('emails.enviarAlerta')
                    ->subject($this->asunto)
                    ->from('sisman.clasem@gmail.com');
    }
}
