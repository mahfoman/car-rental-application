<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewRentalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $car, $user, $start_date, $end_date, $cost, $salutation, $message;

    public function __construct( $car, $user, $start_date, $end_date, $cost, $subject, $salutation, $messages)
    {
        $this->car = $car;
        $this->user = $user;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->cost = $cost;
        $this->subject = $subject;
        $this->salutation = $salutation;
        $this->messages = $messages;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            //subject: 'A New Message has been sent by "'.$this->user->name.'"',
            subject : $this->subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.NewRentalEmail',
            with: [
                'user' => $this->user,
                'car' => $this->car,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'cost' => $this->cost,
                'salutation' => $this->salutation,
                'messages' => $this->messages
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
