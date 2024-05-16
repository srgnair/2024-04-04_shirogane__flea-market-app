<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewer_id',
        'reviewee_id',
        'transaction_id',
        'rating',
        'comment',
    ];

    // 評価を行ったユーザ
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    // 評価されたユーザ
    public function reviewee()
    {
        return $this->belongsTo(User::class, 'reviewee_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
