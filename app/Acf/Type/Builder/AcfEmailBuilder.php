<?php

namespace App\Acf\Type\Builder;

use App\Acf\Type\AcfEmail;

class AcfEmailBuilder
{
    private AcfEmail $instance;

    public function __construct(string $name, string $label, bool $required = false)
    {
        $this->instance = new AcfEmail();
        $this->instance->setValidation(['email']);
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('Email');
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

    public function build(): AcfEmail
    {
        return $this->instance;
    }
}
