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

    public function item()
    {
        return $this->belongsTo(User::class);
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
