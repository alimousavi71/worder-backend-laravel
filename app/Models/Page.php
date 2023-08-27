<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Relation;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function acfConnects(): MorphMany
    {
        return $this->morphMany(AcfConnect::class, 'target');
    }

    public function acfTemplates(): HasManyThrough
    {
        return $this->hasManyThrough(AcfTemplate::class, AcfConnect::class, 'target_id', 'id', 'id', 'acf_template_id')
            ->where('target_type', array_search(static::class, Relation::morphMap()) ?: static::class)
            ->with('fields');

    }
}
