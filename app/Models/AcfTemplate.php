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

    public function acfFields()
    {
        return $this->hasMany(AcfTemplateField::class, 'acf_template_id');
    }
}
