<?php

namespace App\AcfType;

class AcfImage extends AcfBase
{
    public string $defaultValue;

    public string $placeHolder;

    public string $alt = '';

    public int $size = 0;

    public int $width = 0;

    public int $height = 0;

    public array $extensions;

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function getPlaceHolder(): string
    {
        return $this->placeHolder;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }

    public function setExtensions(array $extensions): void
    {
        $this->extensions = $extensions;
    }
}
