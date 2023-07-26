<?php

namespace App\Http\Requests\Admin\Chart;

use Illuminate\Foundation\Http\FormRequest;

class ChartMeetVisitRequest extends FormRequest
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
        $rules['by'] = 'required|in,month,day,week,custom';
        $rules['from-date'] = 'nullable|date_format:Y-m-d';
        $rules['to-date'] = 'nullable|date_format:Y-m-d';

        return $rules;
    }
}
