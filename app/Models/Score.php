<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'total',
        'date_taken',
    ];

    protected $casts = [
        'date_taken' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}