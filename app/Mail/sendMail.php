<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $body;
    public $subject;
    public $files_attached;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body, $subject, $attachments) {
        $this->body = $body;
        $this->subject = $subject;
        $this->files_attached = $attachments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        // dd('success1');
        // return $this->view('mail');
        $email = $this->subject($this->subject)
                ->view('email.general');
        if ($this->files_attached != NULL) {
            $email->attach($this->files_attached);
        }
        return $email;
    }

}
