<?php

namespace App\Http\Controllers\Admin\Acf;

use App\Http\Controllers\Controller;
use View;

class RenderController extends Controller
{
    public function render($type)
    {
        $share = [
            'index' => null,
        ];

        return match ($type) {
            'Text' => View::make('admin.acf.template.field.text', ['type' => 'متنی', ...$share]),
            'Number' => View::make('admin.acf.template.field.number', ['type' => 'عددی', ...$share]),
            'Textarea' => View::make('admin.acf.template.field.textarea', ['type' => 'متنی بزرگ', ...$share]),
            'Email' => View::make('admin.acf.template.field.email', ['type' => 'پست الکترونیکی', ...$share]),
            'Url' => View::make('admin.acf.template.field.url', ['type' => 'لینک', ...$share]),
            'Range' => View::make('admin.acf.template.field.range', ['type' => 'بازه عددی', ...$share]),
            'Select' => View::make('admin.acf.template.field.select', ['type' => 'انتخابی', ...$share]),
            'Image' => View::make('admin.acf.template.field.image', ['type' => 'تصویر', ...$share]),
            default => '',
        };

    }
}
