<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordReport extends Model
{
    use HasFactory,HasUlids;

    protected $primaryKey = 'id';

    protected $fillable = [
        'word_id',
        'reason',
        'is_seen',
        'user_id',
    ];
}
