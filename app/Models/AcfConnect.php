<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcfConnect extends Model
{
    use HasFactory;

    protected $fillable = [
        'acf_template_id',
    ];

    public function target()
    {
        return $this->morphTo();
    }
}
