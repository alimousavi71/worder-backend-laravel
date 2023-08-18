<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'rate',
        'agent',
        'is_seen',
        'is_public',
        'is_collaboration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
