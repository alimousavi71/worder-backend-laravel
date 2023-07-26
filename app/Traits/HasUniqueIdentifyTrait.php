<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

trait HasUniqueIdentifyTrait
{
    public bool $isInt = false;

    abstract public function identifiable(): string;

    protected static function bootHasUniqueIdentifyTrait()
    {
        static::creating(function ($model) {
            $model->{$model->identifiable()} = $model->generateUnique($model->identifiable());
        });
    }

    private function generateUnique($col)
    {
        if ($this->isInt){
            $rnd = rand(1000,999999);
        }
        else{
            $rnd = Str::random(rand(6,10));
        }

        $traits = class_uses($this);
        $usesSoftDeletes = in_array(SoftDeletes::class, $traits);

        $check = self::where($col, $rnd)
            ->when($usesSoftDeletes,function ($q){
                $q->withTrashed();
            })
            ->limit(1)
            ->exists();
        if ($check) {
            $this->generateUnique($col);
        }

        return $rnd;
    }

}
