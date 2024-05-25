<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'text' => 'required | string | max:255',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'コメントを入力してください',
            'text.max' => '255文字以下で入力してください',
            'text.string' => '文字列で入力してください',
        ];
    }
}
