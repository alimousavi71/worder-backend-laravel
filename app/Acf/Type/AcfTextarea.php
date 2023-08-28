<?php

namespace App\Acf\Type;

class AcfTextarea extends AcfBase
{
    public ?int $charLimit = null;

    public ?string $defaultValue = null;

    public ?string $placeHolder;

    public int $rows = 8;

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

    public function getRows(): int
    {
        return $this->rows;
    }
}
