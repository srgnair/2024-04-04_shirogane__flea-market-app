<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationShippingComplete extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = '[coachtechフリマ]商品の受け取りが完了しました。';
    public $recipientName;
    public $itemName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->subject('[coachtechフリマ]商品の受け取りが完了しました。')
            ->view('mail.NotificationShippingComplete')
            ->with([
                'recipientName' => $this->recipientName,
                'itemName' => $this->itemName,
            ]);
    }
}
