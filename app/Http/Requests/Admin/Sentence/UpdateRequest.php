<?php

namespace App\Http\Requests\Admin\Sentence;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'bail|required',
            'category_id' => 'bail|integer|exists:categories,id',
            'sentence' => 'required',
            'translate' => 'required',
            'status' => 'required',
        ];
    }
}
