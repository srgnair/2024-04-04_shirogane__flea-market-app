<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReviewFromBuyerCompleted extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = '[coachtechフリマ]購入者からの評価が完了しました。';
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
        return $this->subject('[coachtechフリマ]購入者からの評価が完了しました。')
            ->view('mail.ReviewFromBuyerCompleted')
            ->with([
                'recipientName' => $this->recipientName,
                'itemName' => $this->itemName,
            ]);
    }
}
