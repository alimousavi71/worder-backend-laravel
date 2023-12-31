<?php

namespace App\Acf\Type\Builder;

use App\Acf\Type\AcfSelect;

class AcfSelectBuilder
{
    private AcfSelect $instance;

    public function __construct(string $name, string $label, bool $required = false)
    {
        $this->instance = new AcfSelect();
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('Text');
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

    public function withSelect(array $items): self
    {
        $this->instance->select = $items;

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
