<?php

namespace App\AcfType\Builder;

use App\AcfType\AcfSelect;

class AcfSelectBuilder
{
    private AcfSelect $instance;

    public function __construct(string $name, string $label, bool $required = false)
    {
        $this->instance = new AcfSelect();
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('Text');
        if ($required) {
            $this->instance->setRequired($required);
        }

    }

    public function withDefaultValue(string $defaultValue): self
    {

        $this->instance->defaultValue = $defaultValue;

        return $this;
    }

    public function withPlaceHolder(string $placeHolder): self
    {
        $this->instance->placeHolder = $placeHolder;

        return $this;
    }

    public function withSelect(string $label, string $value): self
    {
        $this->instance->select[] = [
            'label' => $label,
            'value' => $value,
        ];

        return $this;
    }

    public function withMultiple(bool $multiple): self
    {
        $this->instance->multiple = $multiple;

        return $this;
    }

    public function build(): AcfSelect
    {
        return $this->instance;
    }
}
