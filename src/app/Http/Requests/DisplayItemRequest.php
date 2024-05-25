<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisplayItemRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required',
            'condition' => 'required',
            'brand_name' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|integer|min:300|max:100000',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '商品画像は必須です。',
            'image.image' => 'プロフィール画像は画像ファイルである必要があります。',
            'image.mimes' => 'プロフィール画像はjpeg, png, jpg, gif形式である必要があります。',
            'image.max' => 'プロフィール画像のサイズは2MB以下である必要があります。',
            'category.required' => 'ガテゴリーを入力してください',
            'condition.required' => 'コンディションを入力してください',
            'brand_name.required' => 'ブランド名を入力してください',
            'brand_name.string' => 'ブランド名を文字列で入力してください',
            'brand_name.max' => 'ブランド名を255文字以下で入力してください',
            'item_name.required' => '商品名を入力してください',
            'item_name.string' => '商品名を文字列で入力してください',
            'item_name.max' => '商品名を255文字以下で入力してください',
            'description.required' => '商品説明を入力してください',
            'description.string' => '商品説明を文字列で入力してください',
            'description.max' => '商品説明を255文字以下で入力してください',
            'price.required' => '価格を入力してください',
            'price.min' => '価格は300円以上で設定してください',
            'price.max' => '価格は10万円以内で設定してください',
            'price.integer' => '価格は数値で入力してください',
        ];
    }
}
