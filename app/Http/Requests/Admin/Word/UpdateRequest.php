<?php

namespace App\Http\Requests\Admin\Word;

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
            'category_id' => 'bail|integer|exists:categories,id',
            'word' => 'bail|required|unique:words,word,'.$this->get('id'),
            'translate' => 'required',
            'status' => 'required',
        ];
    }
}
