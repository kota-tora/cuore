<?php

namespace App\Http\Services;

use App\Libraries\SendMail;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class MailService
{
    /**
     * @param $title
     * @param $message
     * @param $from
     * @param $to
     * @param $from_name
     * @return bool
     */
    public function send($title, $message, $from, $to, $from_name = '')
    {
        try {
            Mail::to($to)->send(new SendMail($title, $message, $from, $from_name));
        } catch (Exception $ex) {
            return false;
        }

        return true;
    }
}
