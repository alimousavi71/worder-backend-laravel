<?php

namespace App\AcfType\Builder;

use App\AcfType\AcfText;

class AcfTextBuilder
{
    private AcfText $instance;

    public function __construct(string $name, string $label, bool $required = false)
    {
        $this->instance = new AcfText();
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('Text');
        if ($required) {
            $this->instance->setRequired($required);
        }

    }

    public function withCharLimit(int $charLimit): self
    {
        $this->instance->validation[] = 'max:'.$charLimit;
        $this->instance->charLimit = $charLimit;

        return $this;
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

    public function build(): AcfText
    {
        return $this->instance;
    }
}
