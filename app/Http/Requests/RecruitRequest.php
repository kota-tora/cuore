<?php

namespace App\Http\Requests;

class RecruitRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:2'],
            'mail' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'attendance' => ['required'],
            'experience' => ['required', 'max:5000'],
            'question' => ['max:5000'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'お名前',
            'mail' => 'メールアドレス',
            'age' => '年齢',
            'gender' => '性別',
            'attendance' => '参加頻度',
            'experience' => '経験',
            'question' => '質問',
        ];
    }
}
