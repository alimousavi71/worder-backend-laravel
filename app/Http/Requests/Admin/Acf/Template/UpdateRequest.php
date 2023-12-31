<?php

namespace App\Http\Requests\Admin\Acf\Template;

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
            'title' => 'required|max:255',
            'template' => 'required|max:255',
            'photo' => 'nullable|image|mimes:jpg,png|max:8024',
        ];
    }
}
