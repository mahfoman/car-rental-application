<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RentalConfirmNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $car, $start_date, $end_date, $cost;

    public function __construct( $car, $user, $start_date, $end_date, $cost)
    {
        $this->car = $car;
        $this->user = $user;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->cost = $cost;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->car->name. ' - Car booking request has been sent',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.RentalConfirmEmail',
            with: [
                'user' => $this->user,
                'car' => $this->car,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'cost' => $this->cost,
            ],
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
