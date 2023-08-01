<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'type',
        'description',
        'icon',
    ];

    public function words(): HasMany
    {
        return $this->hasMany(Word::class);
    }

    public function sentences(): HasMany
    {
        return $this->hasMany(Sentence::class);
    }
}
