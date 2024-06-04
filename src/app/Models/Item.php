<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function itemImages()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function itemCategories()
    {
        return $this->hasMany(ItemCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    protected $fillable = [
        'item_name',
        'brand_name',
        'price',
        'description',
        'condition',
        'category_id'
    ];

    public function getConditionAttribute($value)
    {
        $conditions = [
            '1' => '新品、未使用',
            '2' => '未使用に近い',
            '3' => '目立った傷や汚れなし',
            '4' => 'やや傷や汚れあり',
            '5' => '傷や汚れあり'
        ];

        return $conditions[$value] ?? $value;
    }
}
