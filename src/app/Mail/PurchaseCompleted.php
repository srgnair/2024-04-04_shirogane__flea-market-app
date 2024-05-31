<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseCompleted extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = '[coachtechフリマ]商品の購入されました。';
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
        return $this->subject('[coachtechフリマ]商品が購入されました。')
            ->view('mail.PurchaseCompleted')
            ->with([
                'recipientName' => $this->recipientName,
                'itemName' => $this->itemName,
            ]);
    }
}
