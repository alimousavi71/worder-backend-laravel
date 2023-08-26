<?php

namespace App\AcfType;

class AcfRange extends AcfBase
{
    public float $minimum = 0;

    public float $maximum = 0;

    public ?float $defaultMinimum = null;

    public ?float $defaultMaximum = null;

    public function getMinimum(): int
    {
        return $this->minimum;
    }

    public function getMaximum(): int
    {
        return $this->maximum;
    }

    public function getDefaultMinimum(): int
    {
        return $this->defaultMinimum;
    }

    public function getDefaultMaximum(): int
    {
        return $this->defaultMaximum;
    }
}
