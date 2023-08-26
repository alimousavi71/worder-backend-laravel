<?php

namespace App\AcfType;

class AcfText extends AcfBase
{
    public int $charLimit;

    public string $defaultValue;

    public string $placeHolder;

    public function getCharLimit(): int
    {
        return $this->charLimit;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function getPlaceHolder(): string
    {
        return $this->placeHolder;
    }
}
