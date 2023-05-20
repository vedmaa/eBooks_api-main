<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

/**
 * @property $user
 */
class AuthCodeMail extends Mailable
{
    use Queueable, SerializesModels;


    public $code;
    public $message;

    public function build()
    {
        return  $this->markdown('vendor.notifications.email', $this->message->data());
    }
    /**
     * Create a new message instance.
     */
    public function __construct($code)
    {
        $this->message = (new MailMessage)
            ->greeting('Здравствуйте')
            ->line('Ваш код для входа в приложение:')
            ->line($code);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Код для eBooks',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.blade',
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
