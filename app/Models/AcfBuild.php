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
}
