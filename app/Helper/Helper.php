<?php

namespace App\Helper;

use App\Enums\Database\Category\CategoryType;
use App\Enums\Database\Exam\ExamType;
use App\Enums\Database\Sentence\SentenceStatus;
use App\Enums\General\BtnType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Helper
{
    public static function abbreviateNumber($number)
    {
        if ($number >= 1e12) {
            return round($number / 1e12, 1).'T';
        } elseif ($number >= 1e9) {
            return round($number / 1e9, 1).'B';
        } elseif ($number >= 1e6) {
            return round($number / 1e6, 1).'M';
        } elseif ($number >= 1e3) {
            return round($number / 1e3, 1).'k';
        }

        return $number;
    }

    public static function renderCategoryType($type)
    {
        return match ($type) {
            CategoryType::Word => '<span class="badge bg-success">'.trans('panel.category.type.word').'</span>',
            CategoryType::Sentence => '<span class="badge bg-info">'.trans('panel.category.type.sentence').'</span>',
            default => '<span class="badge bg-danger">Not Found</span>',
        };
    }

    public static function renderExamType($type)
    {
        return match ($type) {
            ExamType::Normal => '<span class="badge bg-success">'.trans('panel.exam.type.normal').'</span>',
            ExamType::Timer => '<span class="badge bg-warning">'.trans('panel.exam.type.timer').'</span>',
            default => '<span class="badge bg-danger">Not Found</span>',
        };
    }

    public static function renderSentenceStatus($status)
    {
        return match ($status) {
            SentenceStatus::Pending => '<span class="badge bg-success">'.trans('panel.sentence.status.pending').'</span>',
            SentenceStatus::Publish => '<span class="badge bg-info">'.trans('panel.sentence.status.publish').'</span>',
            default => '<span class="badge bg-danger">Not Found</span>',
        };
    }

    public static function renderWordStatus($status)
    {
        return match ($status) {
            SentenceStatus::Pending => '<span class="badge bg-success">'.trans('panel.word.status.pending').'</span>',
            SentenceStatus::Publish => '<span class="badge bg-info">'.trans('panel.word.status.publish').'</span>',
            default => '<span class="badge bg-danger">Not Found</span>',
        };
    }

    public static function getRouteSmall()
    {
        $routeName = Route::currentRouteName();
        if (str($routeName)->contains('admin.admin')) {
            return 'admin/admin';
        }

        if (str($routeName)->contains('admin.meet')) {
            return 'admin/meet';
        }

        $routeParts = explode('.', $routeName);

        return $routeParts[1];
    }

    public static function permissionReadAble($permission)
    {
        return strtoupper(str_replace('_', ' ', $permission));
    }

    public static function btnMaker($type, $route = '', $title = '')
    {
        return match ($type) {
            BtnType::Warning => '<a target="_blank" href="'.$route.'" class="btn btn-sm btn-warning mx-1">'.$title.'</a>',
            BtnType::Danger => '<a target="_blank" href="'.$route.'" class="btn btn-sm btn-danger mx-1">'.$title.'</a>',
            BtnType::Info => '<a target="_blank" href="'.$route.'" class="btn btn-sm btn-info mx-1">'.$title.'</a>',
            BtnType::Success => '<a target="_blank" href="'.$route.'" class="btn btn-sm btn-success mx-1">'.$title.'</a>',
            default => '',
        };

    }

    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @return int
     */
    public static function formatBytes(int $size, int $precision = 2)
    {
        if ($size > 0) {
            $base = log($size) / log(1024);
            $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];

            return round(pow(1024, $base - floor($base)), $precision).$suffixes[floor($base)];
        } else {
            return $size;
        }
    }

    public static function randAlphaNumeric($length = 7)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function randNumeric($length = 7)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function persianNumberToEnglish($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($persian, $english, $string);
    }

    public static function uniqueIdentity($table, $field)
    {
        $code = self::randAlphaNumeric();
        if (DB::table($table)->where($field, $code)->exists()) {
            self::uniqueIdentity($table, $field);
        }

        return $code;
    }

    public static function slugPersian($string, $separator = '-')
    {
        $_transliteration = [
            '/ä|æ|ǽ/' => 'ae',
            '/ö|œ/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
            '/ç|ć|ĉ|ċ|č/' => 'c',
            '/Ð|Ď|Đ/' => 'D',
            '/ð|ď|đ/' => 'd',
            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
            '/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
            '/Ĝ|Ğ|Ġ|Ģ/' => 'G',
            '/ĝ|ğ|ġ|ģ/' => 'g',
            '/Ĥ|Ħ/' => 'H',
            '/ĥ|ħ/' => 'h',
            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
            '/Ĵ/' => 'J',
            '/ĵ/' => 'j',
            '/Ķ/' => 'K',
            '/ķ/' => 'k',
            '/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
            '/ĺ|ļ|ľ|ŀ|ł/' => 'l',
            '/Ñ|Ń|Ņ|Ň/' => 'N',
            '/ñ|ń|ņ|ň|ŉ/' => 'n',
            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
            '/Ŕ|Ŗ|Ř/' => 'R',
            '/ŕ|ŗ|ř/' => 'r',
            '/Ś|Ŝ|Ş|Ș|Š/' => 'S',
            '/ś|ŝ|ş|ș|š|ſ/' => 's',
            '/Ţ|Ț|Ť|Ŧ/' => 'T',
            '/ţ|ț|ť|ŧ/' => 't',
            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
            '/Ý|Ÿ|Ŷ/' => 'Y',
            '/ý|ÿ|ŷ/' => 'y',
            '/Ŵ/' => 'W',
            '/ŵ/' => 'w',
            '/Ź|Ż|Ž/' => 'Z',
            '/ź|ż|ž/' => 'z',
            '/Æ|Ǽ/' => 'AE',
            '/ß/' => 'ss',
            '/Ĳ/' => 'IJ',
            '/ĳ/' => 'ij',
            '/Œ/' => 'OE',
            '/ƒ/' => 'f',
        ];
        $quotedReplacement = preg_quote($separator, '/');
        $merge = [
            '/[^\s\p{Zs}\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/[\s\p{Zs}]+/mu' => $separator,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        ];
        $map = $_transliteration + $merge;
        unset($_transliteration);

        return preg_replace(array_keys($map), array_values($map), $string);
    }
}
