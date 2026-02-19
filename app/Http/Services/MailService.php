<?php

namespace App\Http\Services;

use App\Libraries\SendMail;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailService
{
    /**
     * @param string $title
     * @param string $message
     * @param string $from
     * @param string $to
     * @param string $from_name
     * @return bool
     */
    public function send(string $title, string $message, string $from, string $to, string $from_name = '', string $return_path = ''): bool
    {
        try {
            Mail::to($to)->send(new SendMail($title, $message, $from, $from_name, $return_path));
        } catch (Exception $ex) {
            Log::error('メール送信に失敗しました', [
                'to' => $to,
                'subject' => $title,
                'error' => $ex->getMessage(),
            ]);
            return false;
        }

        return true;
    }
}
