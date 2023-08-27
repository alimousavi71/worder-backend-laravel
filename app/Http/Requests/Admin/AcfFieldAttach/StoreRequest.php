<?php

namespace App\Http\Requests\Admin\AcfFieldAttach;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        if ($this->get('fields')) {
            return [
                'fields' => 'required|array',
                'fields.*.label' => 'required',
                'fields.*.name' => 'required',
                'fields.*.type' => 'required|in:Text,Textarea,Email,Url,Range,Select,Image',
            ];
        }

        return [];
    }
}
