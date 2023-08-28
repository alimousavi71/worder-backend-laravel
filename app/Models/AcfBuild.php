<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcfBuild extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function connects()
    {
        return $this->hasMany(AcfConnect::class, 'acf_build_id');
    }

    public function stores()
    {
        return $this->hasMany(AcfStore::class, 'acf_build_id');
    }
}
