<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class ResetTokenMail extends Mailable
{
    use Queueable, SerializesModels;

    private $otp;

    /**
     * Create a new message instance.
     *
     * @param $otp
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = "Reset Token is {$this->otp} , Token will expire in 60 minutes";
        $mail = (new MailMessage)
            ->greeting('Good Day!')
            ->line($message)
            ->line('Thank you for using our application!');
        return  $this->subject('Reset Token')
            ->markdown('vendor.notifications.email' , $mail->data());

    }
}
