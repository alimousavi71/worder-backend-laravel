<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_seen',
        'email',
        'figma_link',
        'dribble_link',
        'agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
