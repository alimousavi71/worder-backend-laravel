<?php

namespace App\Acf\Type;

use App\Acf\Type\Builder\AcfDateBuilder;
use App\Acf\Type\Builder\AcfEmailBuilder;
use App\Acf\Type\Builder\AcfImageBuilder;
use App\Acf\Type\Builder\AcfNumberBuilder;
use App\Acf\Type\Builder\AcfRangeBuilder;
use App\Acf\Type\Builder\AcfSelectBuilder;
use App\Acf\Type\Builder\AcfTextareaBuilder;
use App\Acf\Type\Builder\AcfTextBuilder;
use App\Acf\Type\Builder\AcfUrlBuilder;

class AcfTypeFactory
{
    public static function text(string $name, string $label, bool $required = false): AcfTextBuilder
    {
        return new AcfTextBuilder($name, $label, $required);
    }

    public static function number(string $name, string $label, bool $required = false): AcfNumberBuilder
    {
        return new AcfNumberBuilder($name, $label, $required);
    }

    public static function select(string $name, string $label, bool $required = false): AcfSelectBuilder
    {
        return new AcfSelectBuilder($name, $label, $required);
    }

    public static function email(string $name, string $label, bool $required = false): AcfEmailBuilder
    {
        return new AcfEmailBuilder($name, $label, $required);
    }

    public static function image(string $name, string $label, array $extensions, bool $required = false): AcfImageBuilder
    {
        return new AcfImageBuilder($name, $label, $extensions, $required);
    }

    public static function date(string $name, string $label, bool $required = false): AcfDateBuilder
    {
        return new AcfDateBuilder($name, $label, $required);
    }

    public static function textarea(string $name, string $label, bool $required = false): AcfTextareaBuilder
    {
        return new AcfTextareaBuilder($name, $label, $required);
    }

    public static function url(string $name, string $label, bool $required = false): AcfUrlBuilder
    {
        return new AcfUrlBuilder($name, $label, $required);
    }

    public static function range(string $name, string $label, bool $required = false): AcfRangeBuilder
    {
        return new AcfRangeBuilder($name, $label, $required);
    }
}
