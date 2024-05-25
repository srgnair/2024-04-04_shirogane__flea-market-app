<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules()
    {
        return [
            'post_code' => 'required|digits:7',
            'address' => 'required|string|max:255',
            'building_name' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'img.image' => 'プロフィール画像は画像ファイルである必要があります。',
            'img.mimes' => 'プロフィール画像はjpeg, png, jpg, gif形式である必要があります。',
            'img.max' => 'プロフィール画像のサイズは2MB以下である必要があります。',
            'user_name.required' => 'ユーザーネームは必須です。',
            'user_name.max' => 'ユーザーネームは255文字以下である必要があります。',
            'post_code.required' => '郵便番号は必須です。',
            'post_code.digits' => '郵便番号は7桁の数字である必要があります。',
            'address.required' => '住所は必須です。',
            'address.max' => '住所は255文字以下である必要があります。',
            'building_name.max' => '建物名は255文字以下である必要があります。',
        ];
    }
}
