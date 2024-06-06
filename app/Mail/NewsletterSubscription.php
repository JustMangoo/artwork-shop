<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscription extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $unsubscribeLink;

    public function __construct($details, $unsubscribeLink)
    {
        $this->details = $details;
        $this->unsubscribeLink = $unsubscribeLink;
    }

    public function build()
    {
        return $this->view('mail.newsletter-join')
            ->with([
                'details' => $this->details,
                'unsubscribeLink' => $this->unsubscribeLink,
            ]);
    }
}

