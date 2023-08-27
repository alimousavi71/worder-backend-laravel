<?php

namespace App\AcfType;

class AcfBase
{
    public string $label;

    public string $name;

    public string $type;

    public ?string $description = null;

    public bool $required = false;

    public array $validation = [];

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getValidation(): array
    {
        return $this->validation;
    }

    public function setValidation(array $validation): void
    {
        $this->validation = $validation;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): void
    {
        if ($required) {
            $this->validation[] = 'required';
        } else {
            $this->validation[] = 'nullable';
        }

        $this->required = $required;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
