<?php

namespace App\Acf\Type;

class AcfText extends AcfBase
{
    public ?int $charLimit = null;

    public ?string $defaultValue = null;

    public ?string $placeHolder;

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
