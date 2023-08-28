<?php

namespace App\Http\Controllers;

use App\Acf\Type\AcfTypeFactory;

class AcfController extends Controller
{
    public function test()
    {
        $acfText = AcfTypeFactory::image('image', 'image', ['jpg', 'png'], true)
            ->withPlaceHolder('place holder')
            ->withDefaultValue('default value')
            ->withHeight(500)
            ->withWidth(400)
            ->withSize(5000)
            ->build();

        return $acfText->toArray();
    }
}
