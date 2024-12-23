<?php

namespace App\Http\Services;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactService
{
    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function create(Request $request)
    {
        return $this->contact->create([
            'name' => $request->name,
            'mail' => $request->mail,
            'category_id' => $request->category,
            'content' => $request->content
        ]);
    }
}