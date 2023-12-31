<?php

namespace App\Http\Requests\Api\Exam;

use App\Enums\Database\Exam\ExamType;
use App\Enums\Database\Exam\RepositoryType;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
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
            'type' => ['required', new EnumValue(ExamType::class)],
            'repository' => ['required', new EnumValue(RepositoryType::class)],
        ];
    }
}
