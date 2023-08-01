<?php

namespace App\Enums\Assets;

use BenSampo\Enum\Enum;

/**
 * @method static static DataTable()
 * @method static static MultiSelect()
 * @method static static Alert()
 * @method static static Select2()
 * @method static static DataTableOffline()
 * @method static static Quill()
 * @method static static ChartJs()
 * @method static static Datepicker()
 * @method static static Inputmask()
 */
final class ScriptLoader extends Enum
{
    const DataTable = 1;

    const MultiSelect = 2;

    const Alert = 3;

    const Select2 = 4;

    const DataTableOffline = 5;

    const Quill = 6;

    const ChartJs = 7;

    const Datepicker = 8;

    const Inputmask = 9;
}
