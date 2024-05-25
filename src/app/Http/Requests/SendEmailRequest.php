<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
            'recipient' => 'required | string | max:255',
            'subject' => 'required | string | max:255',
            'body' => 'required | string | max:255',
        ];
    }

    public function messages()
    {
        return [
            'recipient.required' => '宛先を選択してください',
            'recipient.max' => '255文字以下で入力してください',
            'recipient.string' => '文字列で入力してください',
            'subject.required' => '件名を入力してください',
            'subject.max' => '255文字以下で入力してください',
            'subject.string' => '文字列で入力してください',
            'body.required' => '本文を入力してください',
            'body.max' => '255文字以下で入力してください',
            'body.string' => '文字列で入力してください',
        ];
    }
}
