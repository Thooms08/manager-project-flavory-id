<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifikasiManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kodeOtp;

    public function __construct($kodeOtp)
    {
        $this->kodeOtp = $kodeOtp;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Verifikasi Manager - Flavory.id',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verifikasi_manager',
        );
    }
}