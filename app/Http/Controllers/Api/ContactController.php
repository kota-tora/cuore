<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Services\ContactService;
use Illuminate\Support\Facades\Request;

class ContactController extends Controller
{
    protected $contact_service;
    public function __construct(ContactService $contact_service)
    {
        $this->contact_service = $contact_service;
    }

    /**
     * @param  ContactRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|void
     */
    public function post(ContactRequest $request)
    {
        $result = $this->contact_service->create($request);

        if ($result) {
            return response('success', 200);
        }
    }
}