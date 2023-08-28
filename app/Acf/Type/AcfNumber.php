<?php

namespace App\Acf\Type;

class AcfNumber extends AcfBase
{
    public ?string $defaultValue = null;

    public ?string $placeHolder;

    public float $maximum;

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function getPlaceHolder(): string
    {
        return $this->placeHolder;
    }

    public function getMaximum(): float
    {
        return $this->maximum;
    }
}
