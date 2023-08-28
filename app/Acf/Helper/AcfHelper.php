<?php

namespace App\Acf\Helper;

use App\Models\Admin;

class AcfHelper
{
    public static function test($string)
    {
        $shortcodePattern = '/\[([A-Z]+)=(\d+)\]/';
        $matches = [];
        $content = $string;
        if (preg_match($shortcodePattern, $string, $matches)) {
            $shortcodeName = $matches[1];
            $shortcodeParam = $matches[2];

            $codeDetect = "[$shortcodeName=$shortcodeParam]";
            $admin = Admin::find($shortcodeParam);

            if ($admin) {
                $content = str($content)->replace($codeDetect, $admin->email);
            }

        }

        return $content;
    }
}
