<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecruitRequest;
use App\Http\Services\RecruiteService;

class RecruitController extends Controller
{
    protected $recruit_service;
    public function __construct(RecruiteService $recruit_service)
    {
        $this->recruit_service = $recruit_service;
    }


    public function post(RecruitRequest $request)
    {
        $result = $this->recruit_service->create($request);

        if ($result) {
            return response('success', 200);
        }
    }
}