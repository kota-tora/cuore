<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecruitRequest;
use App\Http\Services\MailService;
use App\Http\Services\RecruiteService;
use App\Libraries\SendMail\SendMail;

class RecruitController extends Controller
{
    protected $recruit_service;
    protected $mail_service;
    public function __construct(RecruiteService $recruit_service, MailService $mail_service)
    {
        $this->recruit_service = $recruit_service;
        $this->mail_service = $mail_service;
    }


    /**
     * @param  RecruitRequest  $request
     */
    public function post(RecruitRequest $request)
    {
        $result = $this->recruit_service->create($request);

        if ($result) {
            $message = <<<EOF
メンバー応募がありました。

名前：{$request['name']}
年齢：{$request['age']}
性別：{$request['gender']}
EOF;

            $subject = 'メンバー応募がありました';
            $from = config('admin.from_admin_mail');
            $to = config('admin.to_admin_mail');
            $from_name = config('admin.from_admin_name');
            $this->mail_service->send($subject, $message, $from, $to, $from_name);

            return response('success', 200);
        }
    }
}