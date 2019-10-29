<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PanelistInviteNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $panelist_name;
    public $title;
    public $message;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($panelist_name, $title, $message)
    {
        $this->name = $panelist_name;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.new-notification-mail')
            ->with([
                'user_name' => $this->panelist_name,
                'subject' => $this->title,
                'body' => $this->message
            ]);;
    }
}