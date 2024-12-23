<?php

namespace App\Http\Requests;

class ContactRequest extends ApiRequest
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
            'category' => ['required'],
            'content' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'お名前',
            'mail' => 'メールアドレス',
            'category' => 'カテゴリ',
            'content' => 'お問い合わせ内容',
        ];
    }
}
