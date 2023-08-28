<?php

namespace App\Acf\Type\Builder;

use App\Acf\Type\AcfImage;

class AcfImageBuilder
{
    private AcfImage $instance;

    public function __construct(string $name, string $label, array $extensions, bool $required = false)
    {
        $this->instance = new AcfImage();
        $this->instance->setValidation(['image', 'mimes:'.implode(',', $extensions)]);
        $this->instance->setName($name);
        $this->instance->setLabel($label);
        $this->instance->setType('image');
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

    public function withAlt(?string $alt): self
    {
        $this->instance->alt = $alt;

        return $this;
    }

    public function withSize(int $size): self
    {
        $this->instance->size = $size;
        $this->instance->validation[] = 'size:'.$size;

        return $this;
    }

    public function withWidth(?int $width): self
    {
        $this->instance->width = $width;

        return $this;
    }

    public function withHeight(?int $height): self
    {
        $this->instance->height = $height;

        return $this;
    }

    public function build(): AcfImage
    {
        return $this->instance;
    }
}
