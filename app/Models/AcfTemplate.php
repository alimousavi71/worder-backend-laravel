<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcfTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'photo',
        'template',
        'description',
    ];

    public function fields()
    {
        return $this->hasMany(AcfField::class, 'acf_template_id')
            ->orderBy('sort_position');
    }

    public function connected()
    {
        return $this->belongsTo(AcfConnect::class, 'id', 'acf_template_id');
    }
}
