<?php

namespace App\AcfType\Builder;

use App\AcfType\AcfUrl;

class AcfUrlBuilder
{
    private AcfUrl $instance;

    public function __construct(string $name, string $label, bool $required = false)
    {
        $this->instance = new AcfUrl();
        $this->instance->setValidation(['url']);
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('Url');
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

    public function build(): AcfUrl
    {
        return $this->instance;
    }
}
