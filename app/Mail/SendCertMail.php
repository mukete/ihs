<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $mailData;


    public function __construct($mailData)
    {
        //
        $this->mailData = $mailData;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@ihs.test')
                ->view('cert.cert')
                ->with([
                    'name' => $this->mailData['name'],
                    'course' => $this->mailData['course'],
                    ]);
    }
}
