<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function itemName()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    protected $fillable = [
        'seller_id',
        'buyer_id',
        'item_id',
        'transaction_type',
    ];

    public function getTransactionStatusAttribute($value)
    {
        $status = [
            'listed' => '出品中',
            'sold' => '販売済み',
            'purchased' => '購入済み'
        ];

        return $status[$value] ?? $value;
    }
}
