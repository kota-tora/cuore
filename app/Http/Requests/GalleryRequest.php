<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Route;

class GalleryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:2', 'max:255'],
            'type' => ['required'],
            'photo_date' => ['required', 'date'],
            'up_flg' => ['required'],
        ];
    }

    /**
     * 追加時のみ必須のバリデーション
     * @param  Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->sometimes('image', 'required|extensions:jpg,png,jpeg,JPG,JPEG', function () {
            return Route::currentRouteName() == 'admin.gallery.store';
        });
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'type' => 'タイプ',
            'photo_date' => '撮影日',
            'up_flg' => '公開状態',
            'image' => 'ファイル画像',
        ];
    }
}
