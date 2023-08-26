<?php

namespace App\AcfType;

class AcfUrl extends AcfBase
{
    public string $defaultValue;

    public string $placeHolder;

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function getPlaceHolder(): string
    {
        return $this->placeHolder;
    }
}
