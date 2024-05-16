<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected $fillable = [
        'category',
    ];

    public function getCategoryAttribute($value)
    {
        $Categories = [
            '1' => 'ファッション',
            '2' => 'ベビー・キッズ',
            '3' => 'ゲーム・おもちゃ・グッズ',
            '4' => 'メンズ',
            '5' => 'レディース'
        ];

        return $Categories[$value] ?? $value;
    }
}
