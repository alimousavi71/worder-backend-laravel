<?php

namespace App\AcfType\Builder;

use App\AcfType\AcfRange;

class AcfRangeBuilder
{
    private AcfRange $instance;

    public function __construct(string $name, string $label, bool $required = false)
    {
        $this->instance = new AcfRange();
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('Range');
        if ($required) {
            $this->instance->setRequired($required);
        }

    }

    public function withDescription(?string $description): self
    {
        $this->instance->description = $description;

        return $this;
    }

    public function withMinimum(float $minimum): self
    {

        $this->instance->minimum = $minimum;
        $this->instance->validation[] = 'min:'.$minimum;

        return $this;
    }

    public function withMaximum(float $maximum): self
    {

        $this->instance->maximum = $maximum;
        $this->instance->validation[] = 'max:'.$maximum;

        return $this;
    }

    public function withDefaultMinimum(?float $minimum): self
    {

        $this->instance->defaultMinimum = $minimum;

        return $this;
    }

    public function withDefaultMaximum(?float $maximum): self
    {

        $this->instance->defaultMaximum = $maximum;

        return $this;
    }

    public function build(): AcfRange
    {
        return $this->instance;
    }
}
