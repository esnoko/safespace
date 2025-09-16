<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\School;

class AdminOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public School $school;
    public string $otp;

    public function __construct(School $school, string $otp)
    {
        $this->school = $school;
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Your SafeSpace Admin Verification Code')
            ->view('emails.admin_otp')
            ->with([
                'school' => $this->school,
                'otp' => $this->otp,
            ]);
    }
} 