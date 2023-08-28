<?php

namespace App\Acf\Type;

class AcfEmail extends AcfBase
{
    public int $charLimit;

    public ?string $defaultValue = null;

    public ?string $placeHolder;

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function getPlaceHolder(): string
    {
        return $this->placeHolder;
    }
}
