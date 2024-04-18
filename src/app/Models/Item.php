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

    public function itemImages()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function itemCategories()
    {
        return $this->hasMany(ItemCategory::class);
    }

    // public function order()
    // {
    // return $this->belongsTo(User::class);
    // }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    
    protected $fillable = [
        'item_name',
        'brand_name',
        'price',
        'description',
        'condition'
    ];
}
