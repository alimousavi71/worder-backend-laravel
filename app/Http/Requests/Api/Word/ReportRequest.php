<?php

namespace App\Http\Requests\Api\Word;

use App\Enums\Database\WordReport\EWordReportReason;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'word_id' => 'required|int',
            'reason_id' => ['required', new EnumValue(EWordReportReason::class)],
        ];
    }
}
