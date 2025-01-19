<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // This will hold the data passed to the mailable

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {
        return $this->subject('Validation Code') // Email subject
                    ->view('emails.my_mailable') // Blade view for the email content
                    ->with('data', $this->data); // Passing data to the view
    }
}
