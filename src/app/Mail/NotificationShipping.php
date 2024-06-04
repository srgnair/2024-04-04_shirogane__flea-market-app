<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationShipping extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = '[coachtechフリマ]商品が発送されました。';

    public $recipientName;
    public $itemName;

    public function __construct($recipientName, $itemName)
    {
        $this->recipientName = $recipientName;
        $this->itemName = $itemName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.NotificationShipping');
    }
}
