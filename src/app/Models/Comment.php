<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // public function is_like($shop_id)
    // {
    //     return $this->likes()->where('shop_id', $shop_id)->exists();
    // }

    protected $fillable = ['user_id', 'item_id','text'];
}
