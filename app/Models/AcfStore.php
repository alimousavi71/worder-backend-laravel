<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcfStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'acf_build_id',
        'acf_template_id',
        'acf_field_id',
        'value',
        'sort_position',
    ];

    public function target()
    {
        return $this->morphTo();
    }

    public function acfField(): BelongsTo
    {
        return $this->belongsTo(AcfField::class);
    }

    public function acfTemplate(): BelongsTo
    {
        return $this->belongsTo(AcfTemplate::class);
    }
}
