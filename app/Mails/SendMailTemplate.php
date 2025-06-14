<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * @var content
     */

     protected $content;
    public function __construct($content)
    {
        //
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('mail.mail-template')
        //     ->with([
        //     'content' => $this->content
        //     ]
        // );

        return $this->from('administrator@shopmyji.com')
                ->view('mail.mail-template')
                ->with([
                    'content' => $this->content
                ]);
    }
}
