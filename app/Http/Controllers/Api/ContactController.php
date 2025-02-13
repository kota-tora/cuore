<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Services\ContactService;
use App\Http\Services\MailService;
use Illuminate\Support\Facades\Request;

class ContactController extends Controller
{
    protected $contact_service;
    protected $mail_service;
    public function __construct(ContactService $contact_service, MailService $mail_service)
    {
        $this->contact_service = $contact_service;
        $this->mail_service = $mail_service;
    }

    /**
     * @param  ContactRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|void
     */
    public function post(ContactRequest $request)
    {
        $result = $this->contact_service->create($request);

        if ($result) {
            $message = <<<EOF
お問い合わせがありました。

名前：{$request['name']}

内容：{$request['content']}
EOF;

            $subject = 'お問い合わせがありました';
            $from = config('admin.from_admin_mail');
            $to = config('admin.to_admin_mail');
            $from_name = config('admin.from_admin_name');
            $this->mail_service->send($subject, $message, $from, $to, $from_name);

            return response('success', 200);
        }
    }
}