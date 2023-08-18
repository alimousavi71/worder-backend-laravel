<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'sort_order',
    ];

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }
}
