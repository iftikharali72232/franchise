<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Letter;
use Illuminate\Contracts\Queue\ShouldQueue;

class LetterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $letter;

    public function __construct(Letter $letter)
    {
        $this->letter = $letter;
    }

    public function build()
    {
        $email = $this->from(config('mail.from.address'))
                    ->subject($this->letter->offer_title)
                    ->markdown('emails.letters')
                    ->with('letter', $this->letter);

        if ($this->letter->attachment) {
            $email->attach(public_path($this->letter->attachment));
        }

        return $email;
    }

}

