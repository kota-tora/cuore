<?php

namespace App\Libraries;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;

class SendMail extends Mailable
{
    /**
     * @var string
     */
    protected $mail_subject;
    /**
     * @var string
     */
    protected $mail_content;
    /**
     * @var string
     */
    protected $send_from;
    /**
     * @var string
     */
    protected $from_name;

    /**
     * @param string $mail_subject
     * @param string $mail_content
     * @param string $send_from
     * @param string $from_name
     */
    public function __construct(string $mail_subject, string $mail_content, string $send_from, string $from_name)
    {
        $this->mail_subject = $mail_subject;
        $this->mail_content = $mail_content;
        $this->send_from = $send_from;
        $this->from_name = $from_name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->send_from, $this->from_name),
            subject: $this->mail_subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'mail_template.text_mail',
            with: ['content' => $this->mail_content],
        );
    }
}
