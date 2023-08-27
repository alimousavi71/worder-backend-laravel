<?php

namespace App\AcfType\Builder;

use App\AcfType\AcfDate;

class AcfDateBuilder
{
    private AcfDate $instance;

    public function __construct(string $name, string $label, bool $required = false)
    {
        $this->instance = new AcfDate();
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('Date');
        if ($required) {
            $this->instance->setRequired($required);
        }

    }

    public function withDescription(?string $description): self
    {
        $this->instance->description = $description;

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

    public function build(): AcfDate
    {
        return $this->instance;
    }
}
