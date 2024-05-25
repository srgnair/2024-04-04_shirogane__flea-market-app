<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewAdminRequest extends FormRequest
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
            'role' => 'required',
            'user_name' => 'required|string|max:255',
            'email' => 'required | string | max:255 | email | unique:users',
            'password' => 'required | min:8 | max:100 | string'
        ];
    }

    public function messages()
    {
        return [
            'role.required' => '管理者の設定がされていません。',
            'user_name.required' => 'ユーザーネームは必須です。',
            'user_name.max' => 'ユーザーネームは255文字以下である必要があります。',
            'email.required' => 'メールアドレスを入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',
            'email.email' => 'メールアドレスをメール方式で入力してください',
            'email.unique' => 'ほかのメールアドレスを指定してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードを8文字以上で入力してください',
            'password.max' => 'パスワードを100文字以内で入力してください',
            'password.string' => 'パスワードを文字列で入力してください',
        ];
    }
}
