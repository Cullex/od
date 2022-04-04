<?php

namespace App\Jobs;

use App\Mail\OTPMail;
use App\Mail\ResetTokenMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailResetToken implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email;
    private $otp;

    /**
     * Create a new job instance.
     *
     * @param $email
     * @param $otp
     */
    public function __construct($email , $otp)
    {
        $this->email = $email;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new ResetTokenMail($this->otp));
    }

    public function tags()
    {
        return ['notification'];
    }
}
