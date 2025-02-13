<?php

namespace App\Libraries;

use Illuminate\Mail\Mailable;

class SendMail extends Mailable
{
    /**
     * @var string
     */
    protected $mail_subject;
    /**
     * @var string
     */
    protected $content;
    /**
     * @var string
     */
    protected $send_from;
    /**
     * @var string
     */
    protected $from_name;

    /**
     * @param $mail_subject
     * @param $content
     * @param $send_from
     * @param $from_name
     */
    public function __construct($mail_subject, $content, $send_from, $from_name)
    {
        // 件名
        $this->mail_subject = $mail_subject;
        // 本文
        $this->content = $content;
        // 送信元
        $this->send_from = $send_from;
        // 送信元(名前)
        $this->from_name = $from_name;
    }

    public function build()
    {
        return $this->text('mail_template.text_mail')
            ->subject($this->mail_subject)
            ->from($this->send_from, $this->from_name)
            ->with('content', $this->content);
    }
}
