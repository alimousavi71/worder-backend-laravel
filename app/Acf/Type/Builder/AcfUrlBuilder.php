<?php

namespace App\Acf\Type\Builder;

use App\Acf\Type\AcfUrl;

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
        $this->instance->setRequired($required);
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

    public function build(): AcfUrl
    {
        return $this->instance;
    }
}
