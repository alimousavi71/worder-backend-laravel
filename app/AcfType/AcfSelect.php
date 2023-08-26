<?php

namespace App\AcfType;

class AcfSelect extends AcfBase
{
    public string $defaultValue;

    public string $placeHolder;

    public array $select = [];

    public bool $multiple = false;

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function getPlaceHolder(): string
    {
        return $this->placeHolder;
    }

    public function getSelect(): array
    {
        return $this->select;
    }

    public function isMultiple(): bool
    {
        return $this->multiple;
    }
}
