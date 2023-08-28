<?php

namespace App\AcfType\Builder;

use App\AcfType\AcfNumber;

class AcfNumberBuilder
{
    private AcfNumber $instance;

    public function __construct(string $name, string $label, bool $required = false)
    {
        $this->instance = new AcfNumber();
        $this->instance->setValidation(['numeric']);
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('Number');
        $this->instance->setRequired($required);
    }

    public function withDescription(?string $description): self
    {
        $this->instance->description = $description;

        return $this;
    }

    public function withMaximum(float $maximum): self
    {

        $this->instance->validation[] = 'max:'.$maximum;

        $this->instance->maximum = $maximum;

        return $this;
    }

    public function withDefaultValue(?string $defaultValue): self
    {

        $this->instance->defaultValue = $defaultValue;

        return $this;
    }

    public function withPlaceHolder(?string $placeHolder): self
    {
        $this->instance->placeHolder = $placeHolder;

        return $this;
    }

    public function build(): AcfNumber
    {
        return $this->instance;
    }
}
