<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => 'required',
            'comment' => 'required | string | max:255',
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価を選択してください',
            'comment.required' => 'コメントを入力してください',
            'comment.max' => '255文字以下で入力してください',
            'comment.string' => '文字列で入力してください',
        ];
    }
}
