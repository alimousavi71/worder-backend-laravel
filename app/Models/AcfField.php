<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcfField extends Model
{
    use HasFactory;

    protected $casts = [
        'props' => 'json',
    ];

    protected $fillable = [
        'label',
        'name',
        'description',
        'required',
        'type',
        'props',
    ];

    public function acfTemplate()
    {
        return $this->belongsToMany(AcfTemplate::class, 'acf_template_id');
    }
}
