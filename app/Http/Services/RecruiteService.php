<?php

namespace App\Http\Services;

use App\Models\Recruit;
use Illuminate\Http\Request;

class RecruiteService
{
    protected $recruit;

    public function __construct(Recruit $recruit)
    {
        $this->recruit = $recruit;
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function create(Request $request)
    {
        return $this->recruit->create([
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
            'gender' => $request->gender,
            'attendance' => $request->attendance,
            'experience' => $request->experience,
            'question' => $request->question
        ]);
    }
}