<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $transaction_id;
    public $room;
    public $rate;
    public $date_start;
    public $date_end;
    public $reason_cause;
    public function __construct($transaction_id, $room, $rate, $date_start, $date_end, $reason_cause)
    {
        $this->transaction_id = $transaction_id;
        $this->room = $room;
        $this->rate = $rate;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->reason_cause = $reason_cause;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Cancelled',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.adminEmail',
            with: ['transaction_id' => $this->transaction_id, 'room' => $this->room, 'rate' => $this->rate, 'date_start' => $this->date_start, 'date_end' => $this->date_end, 'reason_cause'=>$this->reason_cause]
       
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
