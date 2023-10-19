<?php

namespace App\Mail;

use App\Models\Manager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function build()
    {
        return $this->subject('Invite Mail From Annapoorani Foods - Invite You to Access the Zwork Technology Billing and Monthly Accounts Management Software')
                ->view('email.invite');
    }
}
